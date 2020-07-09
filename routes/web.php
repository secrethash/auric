<?php

use Illuminate\Support\Facades\Route;


// $now = now()->addMinutes(60);
// $date = $now->format('Ymd');
// $id = (($now->format('H') * 20) + ($now->format('i') / 3)) + 1;
// $id = floor($id);
// $id = str_pad($id, 3, '0', STR_PAD_LEFT);

// dump($id);

// $now = Carbon::now();
// $date = $now->format('Ymd');
// $id = (($now->format('H') * 20) + ($now->format('i') / 3)) + 1;
// // dd($date.floor($uid));

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

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('account', 'UserController@account')->name('account');
    Route::get('referral', 'UserController@referral')->name('referral');
    Route::get('wallet', 'UserController@wallet')->name('wallet');
    Route::get('wallet/add', 'UserController@walletAdd')->name('wallet.add');
    Route::post('wallet/pay', 'UserController@pay')->name('wallet.pay');
    Route::post('wallet/pay/verify/{transaction}', 'UserController@payVerify')->name('wallet.pay.verify');
    Route::get('logout', 'UserController@logout')->name('logout');
});

Route::prefix('invest')->name('invest.')->middleware('auth')->group(function () {
    Route::get('{lobby?}', 'InvestController@index')->name('index');
    Route::post('create/{lobby}/{period}', 'InvestController@create')->name('create');
    Route::get('preprocess/{token}', 'InvestController@preProcess')->name('process');
});


Route::prefix('console')->group(function () {
    Voyager::routes();
});

Auth::routes(['verify'=>true]);



