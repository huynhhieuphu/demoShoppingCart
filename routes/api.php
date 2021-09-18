<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([
    'namespace' => 'Api',
    'as' => 'api.'
], function(){
    Route::get('/danh-muc', 'DemoController@index')->name('category.index');
    Route::post('/danh-muc', 'DemoController@store')->name('category.store');
    Route::get('/danh-muc/{id}', 'DemoController@show')->name('category.show');
    Route::put('/danh-muc/{id}', 'DemoController@update')->name('category.update');
    Route::delete('/danh-muc/{id}', 'DemoController@destroy')->name('category.destroy');

    Route::get('/danh-muc-view', 'DemoController@loadView')->name('category.loadView');
});

