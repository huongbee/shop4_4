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

}
