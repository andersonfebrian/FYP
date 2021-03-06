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

Route::middleware(['admin.auth'])->group(function() {
    
    Route::get('/', 'PageController@index')->name('index');

    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('users', 'PageController@users')->name('users.index');
    Route::get('stores', 'PageController@stores')->name('stores.index');
    Route::get('products', 'PageController@products')->name('products.index');

    Route::resource('banners', 'BannerController')->name('*', 'banners');
    Route::get('activity-logs', 'ActivityController@index')->name('activity-logs.index');

    Route::get('transactions', 'PageController@transactions')->name('transactions.index');
    Route::get('purchases', 'PageController@purchases')->name('purchases.index');
});

Route::middleware('guest')->group(function() {
    Route::get('login', 'AuthController@show')->name('login.show');
    Route::post('login', 'AuthController@login')->name('login');
});
