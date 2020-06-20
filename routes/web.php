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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home.index');

Route::get('/shop', 'Shop\ProductsController@index')->name('shop.list');
Route::get('/shop/{product?}', 'Shop\ProductsController@show')->name('shop.show');

Route::prefix('user')->name('user.')->group(function () {
    Route::get('account', 'UserController@account')->name('account');
    Route::get('referral', 'UserController@referral')->name('referral');
    Route::get('logout', 'UserController@logout')->name('logout');
});


Route::prefix('console')->group(function () {
    Voyager::routes();
});

Auth::routes(['verify'=>true]);



