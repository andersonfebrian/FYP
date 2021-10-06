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
  // Payment
  Route::get('payment', 'PaymentController@show')->name('payment.show');

  // Purchase History
  Route::get('purchase-history', 'PurchaseHistoryController@show')->name('purchase-history');

  // Cart
  Route::get('cart', 'CartController@show')->name('cart');

  // Profile
  Route::get('profile', 'ProfileController@index')->name('profile');
  Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');

  Route::put('profile/{user}/update', 'ProfileController@update')->name('profile.update');  
  
  Route::get('store/create', 'StoreController@create')->name('store.create');

  Route::middleware(['has.store'])->group(function() {
    Route::get('store-dashboard', 'StoreDashboardController@index')->name('store-dashboard');
    Route::resource('store-dashboard/products', 'StoreDashboardProductController')->name('*', 'product');

    Route::get('store-dashboard/income', 'StoreDashboardController@showIncome')->name('store-dashboard.income.show');
  });

  Route::get('product-review/{purchase}', 'ProductReviewController@show')->name('product-review.show');
  Route::post('product-review', 'ProductReviewController@store')->name('product-review.store');

  Route::get('logout', 'AuthController@logout')->name('logout');
});

Route::middleware('guest')->group(function(){
  Route::get('login', 'AuthController@login')->name('login.show');
  Route::post('login', 'LoginController@authenticate')->name('auth-login');

  Route::get('register', 'AuthController@register')->name('register.show');
  Route::post('register', 'RegisterController@register')->name('auth-register');

  Route::get('forgot-password', 'ForgetPasswordController@showForgotPasswordForm')->name('password.request');
});

Route::get('store/{store}', 'StoreController@show')->name('store.show');

Route::resource('product', 'ProductController')->name('*', 'product');

Route::get('product-page')->name('product-page');

Route::post('search', 'SearchController@query')->name('search');

Route::get('/', 'PageController@index')->name('index');