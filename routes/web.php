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


Route::get('/', 'Controller@index');

Route::resource('product', 'productController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


route::post('/addToCart', 'productController@addToCart')->name('addtocart');
route::get('/cleanAllCart', 'productController@cleanAllCart')->name('clanAllCart');
route::get('/removeToCart/{id}', 'productController@removeToCart')->name('rmToCart');
route::get('/removeProductToCart/{id}', 'productController@removeProductToCart')->name('rmProductToCart');
route::get('/search', 'productController@searchProducts')->name('search');