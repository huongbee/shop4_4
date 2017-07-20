<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Products;
use App\TypeProduct;

class PageController extends Controller
{
    public function getTrangchu(){

        $slide = Slide::all();
        $promotion_product = Products::whereColumn('unit_price','>','promotion_price')
                                    ->paginate(8);
        $new_product = Products::orderBy('id','DESC')
                                ->limit(4)
                                ->get();

        
    	return view('pages.index',compact('slide','promotion_product','new_product'));
    }

    public function getProductByType($id){
        $product = Products::where([
                                ['id_type','=',$id]
                            ])->paginate(6);
        $type_product = TypeProduct::where('id',$id)->first();
        //dd($type);
    	return view('pages.type',compact('product','type_product'));
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