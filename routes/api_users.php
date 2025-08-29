<?php

use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoldController;
use App\Http\Controllers\Api\BullionController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\UserApp\AppController;




use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\Api\CurrencyApi\CurrencyApiController;






Route::group(['prefix' => 'v1', 'middleware' => ['localization']], function () {

//   test


    // Authentication API - Login with username and password
    Route::post('login', [UserAuthenticationController::class, 'login']);
    // Registration API - Register new user
    Route::post('register', [UserAuthenticationController::class, 'register']);

    // User data API - Get user details using token or user ID
    Route::get('my-profile', [UserAuthenticationController::class, 'getUserData']);


    Route::get('request-vacations', [UserAuthenticationController::class, 'requestVacations']);






});
