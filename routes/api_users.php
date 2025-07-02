<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApp\AppController;
use App\Http\Controllers\Api\UserApp\RateController;
use App\Http\Controllers\Api\UserApp\VisitController;
use App\Http\Controllers\Api\UserApp\BannerController;
use App\Http\Controllers\Api\UserApp\CarTypeController;
use App\Http\Controllers\Api\UserApp\TicketController;
use App\Http\Controllers\Api\UserApp\ServiceController;
use App\Http\Controllers\Api\UserApp\UserNotificationController;
use App\Http\Controllers\Api\UserApp\UserAuthenticationController;
use App\Models\CarType;


Route::get('currency-api', [CurrencyApiController::class, 'getRates']);

Route::group(['prefix' => 'v1', 'middleware' => ['localization', 'profile_json']], function () {

    

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', [AppController::class, 'initData']);           //return all banners,categories,districts,guidelines,packages
        Route::get('/social', [AppController::class, 'getSocial']);           //return all banners,categories,districts,guidelines,packages

    });


   


});





