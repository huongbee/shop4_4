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

Route::post('checkout',[
	'as'=>'checkout',
	'uses'=>'PageController@postCheckout'
]);


Route::get('shopping-cart',[
	'as'=>'shoppingcart',
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


Route::get('add-to-cart/{id}',[
	'as'=>'add_to_cart',
	'uses'=>'PageController@addToCart'
]);

Route::get('delete-cart/{id}',[
	'as'=>'delete_cart',
	'uses'=>'PageController@deleteCart'
]);


Route::post('edit-cart',[
	'as'=>'edit_cart',
	'uses'=>'PageController@editCart'
]);


Route::get('xac-nhan-don-hang/{id_bill}',[
	'as'=>'accept_cart',
	'uses'=>'PageController@getAcceptCart'
]);


Route::post('xac-nhan-don-hang/{id_bill}',[
	'as'=>'accept_cart',
	'uses'=>'PageController@postAcceptCart'
]);



Route::get('admin-login',[
	'as'=>'admin.login',
	'uses'=>'AdminController@getLogin'
]);
Route::post('admin-login',[
	'as'=>'admin.login',
	'uses'=>'AdminController@postLogin'
]);


Route::group(['prefix'=>'admin'],function(){

	Route::get('list-type',[
		'as'=>'ds_loaisp',
		'uses'=>'AdminController@getListType'
	]);




});