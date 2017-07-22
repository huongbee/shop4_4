<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[
	'as'=>'trangchu',
	'uses'=>'PageController@getTrangchu'
]);

Route::get('type-{id}',[
	'as'=>'type',
	'uses'=>'PageController@getProductByType'
]);


Route::get('detail-{id}',[
	'as'=>'detail',
	'uses'=>'PageController@getDetailProduct'
]);


Route::get('checkout',[
	'as'=>'checkout',
	'uses'=>'PageController@getCheckout'
]);

Route::get('shopping-cart',[
	'as'=>'cart',
	'uses'=>'PageController@getShoppingCart'
]);

Route::get('login',[
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);


Route::get('register',[
	'as'=>'register',
	'uses'=>'PageController@getRegister'
]);