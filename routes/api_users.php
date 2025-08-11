<?php

use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoldController;
use App\Http\Controllers\Api\BullionController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\UserApp\AppController;
use App\Http\Controllers\Api\UserApp\RateController;
use App\Http\Controllers\Api\UserApp\VisitController;
use App\Http\Controllers\Api\UserApp\BannerController;
use App\Http\Controllers\Api\UserApp\TicketController;
use App\Http\Controllers\Api\UserApp\CarTypeController;
use App\Http\Controllers\Api\UserApp\ServiceController;
use App\Http\Controllers\Api\CurrencyApi\CurrencyApiController;
use App\Http\Controllers\Api\UserApp\UserNotificationController;
use App\Http\Controllers\Api\UserApp\UserAuthenticationController;



Route::group(['prefix' => 'v1', 'middleware' => ['localization']], function () {
    Route::get('currency-api', [CurrencyApiController::class, 'getRates']);
    Route::get('currencies', [CurrencyController::class, 'index']);
    Route::get('gold-prices', [GoldController::class, 'index']);
    Route::get('bullion-prices', [BullionController::class, 'index']);
    
    



    


    // Route::group(['prefix' => 'home'], function () {
    //     Route::get('/', [AppController::class, 'initData']);           //return all banners,categories,districts,guidelines,packages
    //     Route::get('/social', [AppController::class, 'getSocial']);           //return all banners,categories,districts,guidelines,packages

    // });
});
