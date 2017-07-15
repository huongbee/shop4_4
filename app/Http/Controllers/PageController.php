<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getTrangchu(){
    	return view('pages.index');
    }

    public function getProductByType(){
    	return view('pages.type');
    }


    public function getDetailProduct(){
    	return view('pages.detail');
    }

    public function getCheckout(){
    	return view('pages.checkout');
    }

    public function getLogin(){
    	return view('pages.login');
    }

    public function getShoppingCart(){
    	return view('pages.cart');
    }

    public function getRegister(){
    	return view('pages.register');
    }
}
