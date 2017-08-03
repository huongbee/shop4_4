<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\TypeProduct;
use View;
use Session;
use App\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $type = TypeProduct::all();
        View::share('type',$type);

        View::composer(['layout','pages.cart','pages.checkout'],function($view){
            if(Session::has('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                
                $view->with([
                    'cart'=>Session::get('cart'),
                    'product_cart'=>$cart->items,
                    'totalPrice'=> $cart->totalPrice
                ]);
            }

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
