<?php

use Illuminate\Http\Client\Request;
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

Route::middleware(['browser.auth'])->group(function() {

  // Profile
  Route::get('profile', 'ProfileController@index')->name('profile');
  Route::get('profile/edit', 'ProfileController@edit')->name('profile.show');

  Route::put('profile/{user}/update', 'ProfileController@update')->name('profile.update');


  // Route::middleware(['has.store'])->group(function() {
    Route::get('store-dashboard', 'StoreController@dashboard')->name('store-dashboard');
    Route::get('store', 'StoreController@index')->name('store-index');

  // });
  Route::resource('store-dashboard/products', 'StoreProductController')->name('*', 'product');

  Route::get('logout', 'AuthController@logout')->name('logout');
});

Route::middleware('guest')->group(function(){
  Route::get('login', 'AuthController@login')->name('login.show');
  Route::post('login', 'LoginController@authenticate')->name('auth-login');

  Route::get('register', 'AuthController@register')->name('register.show');
  Route::post('register', 'RegisterController@register')->name('auth-register');

});

Route::get('product-page')->name('product-page');

Route::post('search', 'SearchController@query')->name('search');

Route::get('/', 'PageController@index')->name('index');