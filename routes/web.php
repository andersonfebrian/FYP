<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function() {
    Route::get('reset-password/{token}', 'ForgetPasswordController@showResetPasswordForm')->name('password.reset');
    
    Route::post('reset-password', 'ForgetPasswordController@resetPassword')->name('password.update');
});