<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function(){
    Route::post('register',[RegistrationController::class,'create']);
    Route::post('login',[LoginController::class,'login']);
});