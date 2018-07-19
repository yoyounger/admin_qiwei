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

Route::get('/', function () {
    return view('welcome');
});

//商家分类
Route::resource('shopcategories','ShopCategoriesController');
//商家
Route::resource('shops','ShopsController');
//商家审核操作
Route::post('yes','ShopsController@yes')->name('yes');
Route::post('no','UsersController@no')->name('no');
//账户
Route::resource('users','UsersController');
//管理员
Route::resource('admins','AdminsController');
