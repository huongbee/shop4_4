<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Products;
use App\TypeProduct;

class AdminController extends Controller
{

	public function getLogin(){
		return view('admin.pages.login');
	}


    public function getListType(){
        $listType = TypeProduct::all();
    	return view('admin.pages.loaisp',compact('listType')); 
                    //vào folder admin->pages->loaisp.blade.php
    }





    public function postLogin(Request $req){
    	$arr = array(
    					'email'=>$req->inputEmail,
    					'password'=>$req->inputPassword

    				);
    	$admin = Auth::guard('admin')->attempt($arr);
    	if($admin){

            return redirect()->route('ds_loaisp');

    	}
    	else{
    		echo 'đăng nhập thất bại';
    	}
    }


    public function getOut(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }



    public function getEditType(Request $req){
        $type = TypeProduct::where('id',$req->id)->first();
        if($type){
            return view('admin.pages.edit_type',compact('type'));
        }
        else{
            return redirect()->back();
        }

    }

    public function postEditType(Request $req){
        //$type = new TypeProduct;
        $type = TypeProduct::where('id',$req->id)->first();
        if($type){
            $type->name = $req->name;
            $type->description = $req->desc;
            if($req->hasFile('hinh')){

                $image = $req->file('hinh');

                if($image->getClientSize()<2*1024*1024){ //kiểm tra filesize 2Mb
                    
                    $base_name = $image->getClientOriginalName(); //a.png

                    $name = pathinfo($base_name,PATHINFO_FILENAME).time(); //a12345677654

                    $ext = $image->getClientOriginalExtension(); //png

                    $arrExt = array('png','gif','jpg');

                    if(!in_array($ext,  $arrExt)){
                        return redirect()->back()->with('loi','File không được phép chọn');
                    }
                    $final_name = $name.'.'.$ext;
                    $image->move('shopping/image/product/',$final_name);

                    //lấy thông tin sẽ lưu vào db
                    $type->image = $final_name;
                }
                else{
                    return redirect()->back()->with('loi','File quá lớn');
                }
            }
            //ko chọn file thì ko update cột image

            $type->save();
            return redirect()->route('ds_loaisp')->with('thanhcong','Sửa thành công');
            
        }
        else{
            return redirect()->back()->with('loi','Không tồn tại sp này');
        }

        
    }


    public function getDeleteType($id){
        $type = TypeProduct::where('id',$id)->first();
        if($type){
            $product = Products::where('id_type',$id)->first();
            if($product){
                return redirect()->back()->with('loi','Không thể xóa loại sp này');
            }
            else{
                $type->delete();
                return redirect()->back()->with('thanhcong','Đã xóa');
            }
        }
        else{
            return redirect()->back()->with('loi','Không tồn tại sp này');
        }
    }

}
