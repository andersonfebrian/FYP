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
Route::post('biosecure/image-processing', 'API\BiosecureController@initScript')->name('biosecure.image-processing');

Route::post('biosecure/store-frame', 'API\BiosecureController@storeFrame')->name('biosecure.store-frame');

Route::post('image/store', 'API\ProductImageController@store')->name('store-image');
Route::post('image/remove', 'API\ProductImageController@remove')->name('remove-image');
Route::get('{product}/images', 'API\ProductImageController@retrieve')->name('product-images');