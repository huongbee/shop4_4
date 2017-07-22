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


    public function getDetailProduct($id){
        $product = Products::where('id',$id)->first();

        $id_type = $product->id_type;
        $related_product = Products::where('id_type',$id_type)->paginate(3);

        $best_seller = Products::selectRaw("products.id,products.name,products.promotion_price,products.image, sum(bill_detail.quantity) as tongsoluong")
                    ->join('bill_detail',function($join){
                        $join->on('products.id','=','bill_detail.id_product');
                            
                    })->groupBy('products.id','products.name','products.promotion_price','products.image')
                    ->orderBy('tongsoluong','DESC')
                    ->limit(10)->get();



        //dd($best_seller);

    	return view('pages.detail',compact('product','related_product','best_seller'));
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
