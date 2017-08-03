<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{

	public function getLogin(){
		if(Auth::guard('admin')->check()){
			echo 'thành công';
		}
		else
			return view('admin.pages.login');
	}


    public function getListType(){

    	return view('admin.pages.loaisp'); //vào folder admin->pages->loaisp.blade.php
    }


    public function postLogin(Request $req){
    	$arr = array(
    					'email'=>$req->inputEmail,
    					'password'=>$req->inputPassword

    				);
    	$admin = Auth::guard('admin')->attempt($arr);
    	if($admin){
    		echo Auth::guard('admin')->user()->full_name;
    	}
    	else{
    		echo 'đăng nhập thất bại';
    	}
    }
}
