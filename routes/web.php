<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/the-loai/{slug}', 'HomeController@category')->name('home.category');
Route::get('/san-pham/{slug}', 'HomeController@product')->name('home.product');

// login shopping
Route::group([
    'as' => 'customer'
], function(){
    Route::get('/dang-nhap', 'CustomerController@login')->name('login');
    Route::post('/dang-nhap', 'CustomerController@chkLogin')->name('chkLogin');
    Route::post('/dang-xuat', 'CustomerController@logout')->name('logout');
    Route::get('/dang-ky', 'CustomerController@create')->name('create');
    Route::post('/dang-ky', 'CustomerController@store')->name('store');
});


// cart shopping
Route::group([
    'prefix' => '/cart',
    'as' => 'cart.'
], function (){
    Route::get('/', 'CartController@index')->name('index');
    Route::get('/add/{id}', 'CartController@add')->name('add');
    Route::get('/update/{id}', 'CartController@update')->name('update');
    Route::get('/remove/{id}', 'CartController@remove')->name('remove');
    Route::get('/clear', 'CartController@clear')->name('clear');
});

// Admin page
Route::get('/admin/login','Admin\LoginController@index')->name('admin.login')->middleware('checkLogout');
Route::post('/admin/login', 'Admin\LoginController@handleLogin')->name('admin.handle.login');

Route::group([
    'prefix' => '/admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => 'checkLogin',
], function(){
    Route::get('/','SiteController@index')->name('site.index');

    Route::resources([
        'category' => 'CategoryController',
        'user' => 'UserController',
        'product' => 'ProductController',
        'customer'=> 'CustomerController',
    ]);

    Route::get('/logout', 'LoginController@logout')->name('logout');
});

