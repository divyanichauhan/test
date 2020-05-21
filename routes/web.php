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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => 'is_admin'], function () {
    Route::get('home', 'HomeController@adminHome')->name('admin.home');
    Route::post('category/store','CategoryController@store');
    Route::get('category/edit/{id}','CategoryController@edit');
    Route::post('category/update','CategoryController@update');
    Route::get('category/delete/{id}','CategoryController@destroy');

    Route::resource('category', 'CategoryController');
});
    Route::get('cat-list','CategoryController@CatList');
