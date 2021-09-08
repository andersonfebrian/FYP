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