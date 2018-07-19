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
//管理员登录
Route::get('login','SessionsController@login')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('logout','SessionsController@destroy')->name('logout');
//管理员登录修改个人密码
Route::post('password','SessionsController@password')->name('password');
Route::get('reset','SessionsController@reset')->name('reset');
//重置商户密码
Route::get('set/{user}','UsersController@set')->name('set');
Route::post('repassword{user}','UsersController@repassword')->name('repassword');



