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

Route::get('/lien-he', 'HomeController@showFormContact')->name('home.from.contact');
Route::post('/lien-he', 'HomeController@sendmail')->name('home.send.mail');

// login shopping
Route::group([
    'as' => 'admin.customer.',
    'namespace' => 'Admin',
], function(){
    Route::get('/dang-nhap', 'CustomerController@showLoginForm')->name('login.form');
    Route::post('/dang-nhap', 'CustomerController@login')->name('login');
    Route::get('/dang-xuat', 'CustomerController@logout')->name('logout');
    Route::get('/dang-ky', 'CustomerController@showRegistrationForm')->name('register.form');
    Route::post('/dang-ky', 'CustomerController@register')->name('register');
});

// cart shopping
Route::group([
    'prefix' => '/cart',
    'as' => 'cart.',
    'middleware' => 'chkLoginCus',
], function (){
    Route::get('/', 'CartController@index')->name('index');
    Route::get('/add/{id}', 'CartController@add')->name('add');
    Route::get('/update/{id}', 'CartController@update')->name('update');
    Route::get('/remove/{id}', 'CartController@remove')->name('remove');
    Route::get('/clear', 'CartController@clear')->name('clear');
});

// checkout
Route::group([
    'prefix' => '/checkout',
    'as' => 'checkout.',
    'middleware' => 'chkLoginCus',
], function(){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');
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

