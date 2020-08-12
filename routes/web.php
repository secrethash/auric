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
Route::get('/home', 'HomeController@index')->middleware(['auth', 'verifiedphone'])->name('home.index');

Route::get('/shop', 'Shop\ProductsController@index')->name('shop.list');
Route::get('/shop/{product?}', 'Shop\ProductsController@show')->name('shop.show');

Route::prefix('user')->name('user.')->middleware(['auth', 'verifiedphone'])->group(function () {

    Route::get('account', 'UserController@account')->name('account');
    Route::get('referral', 'UserController@referral')->name('referral');

    Route::prefix('wallet')->name('wallet.')->group(function () {
        Route::get('/', 'UserController@wallet')->name('index');
        Route::get('/add', 'UserController@walletAdd')->name('add');
        Route::post('/pay', 'UserController@pay')->name('pay');
        Route::post('/pay/verify/{transaction}', 'UserController@payVerify')->name('pay.verify');
    });


    Route::prefix('withdraw')->name('withdraw.')->group(function () {
        Route::get('/', 'WithdrawalsController@index')->name('index');
        Route::get('create', 'WithdrawalsController@create')->name('create');
        Route::post('create', 'WithdrawalsController@store');
        Route::get('verify/{token}', 'WithdrawalsController@verifyShow')->name('verify');
        Route::post('verify/{token}', 'WithdrawalsController@verify');
        Route::get('verify/resend/{token}', 'WithdrawalsController@resend')->name('verify.resend');

        Route::prefix('bank')->name('bank.')->group(function () {
            Route::get('/', 'WithdrawalsController@bank')->name('index');
            Route::get('/create/{type?}', 'WithdrawalsController@bankCreate')->name('create');
            Route::post('/create/{type?}', 'WithdrawalsController@bankStore');
            Route::get('/destroy/{id}', 'WithdrawalsController@bankDestroy')->name('destroy');
        });


    });

    Route::get('logout', 'UserController@logout')->middleware('auth')->name('logout');
});

Route::prefix('auth/phone')->name('auth.phone.')->middleware('auth')->group(function () {
    Route::get('verify', 'Auth\PhoneVerificationController@show')->name('verify.notice');
    Route::get('verify/resend/{token}', 'Auth\PhoneVerificationController@resend')->name('verify.resend');
    Route::post('verify', 'Auth\PhoneVerificationController@verify')->name('verify');
});

Route::prefix('invest')->name('invest.')->middleware(['auth', 'verifiedphone'])->group(function () {
    Route::get('{lobby?}', 'InvestController@index')->name('index');
    Route::get('{lobby}/periods', 'InvestController@periods')->name('periods');
    Route::get('{lobby}/records', 'InvestController@records')->name('records');
    Route::post('create/{lobby}/{period}', 'InvestController@create')->name('create');
    // Route::get('preprocess/{token}', 'InvestController@preProcess')->middleware('throttle:1,2')->name('process');
});


Route::prefix('console')->group(function () {
    Voyager::routes();
});
// Route::domain('console.'.config('app.domain'))->group(function () {
//     Voyager::routes();
// });

Auth::routes(['verify'=>true]);



Route::get('{page}', 'PageController@show')->where('page', '.*')->name('page');
