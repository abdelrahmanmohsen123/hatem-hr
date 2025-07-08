<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Api\Admin\Gold\GoldController;
use App\Http\Controllers\Api\Admin\User\UserController;
use App\Http\Controllers\Api\Admin\Visit\VisitController;
use App\Http\Controllers\Api\Admin\Banner\BannerController;
use App\Http\Controllers\Api\Admin\Ticket\TicketController;
use App\Http\Controllers\Api\Admin\Bullion\BullionController;
use App\Http\Controllers\Api\Admin\Service\ServiceController;
use App\Http\Controllers\Api\Admin\Setting\SettingController;
use App\Http\Controllers\Api\Admin\Currency\CurrencyController;
use App\Http\Controllers\Api\Admin\Authentication\AuthController;
use App\Http\Controllers\Api\Admin\Notification\NotificationController;



Route::group(['prefix' => 'v1/admins', 'middleware' => ['localization']], function () {

    // Auth Routes
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:admin');
        Route::post('/refresh', [AuthController::class, 'refreshToken'])->middleware('auth:admin');
    });

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {

        

        // currencies
        Route::prefix('currencies')->group(function () {
            Route::get('/', [CurrencyController::class, 'index']);
            Route::get('/{currency_price}', [CurrencyController::class, 'show']);
            Route::post('/{currency_price}', [CurrencyController::class, 'update']);
        });
        // golds
        Route::prefix('golds')->group(function () {
            Route::get('/', [GoldController::class, 'index']);
            Route::get('/{gold_price}', [GoldController::class, 'show']);
            Route::post('/{gold_price}', [GoldController::class, 'update']);
        });

        // bullions
        Route::prefix('bullions')->group(function () {
            Route::get('/', [BullionController::class, 'index']);
            Route::get('/{bullion_price}', [BullionController::class, 'show']);
            Route::post('/{bullion_price}', [BullionController::class, 'update']);
        });

        // Settings
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'index']);
            Route::put('/', [SettingController::class, 'update']);
        });

        // Tickets
        Route::prefix('tickets')->group(function () {
            Route::get('/', [TicketController::class, 'index']);
            Route::post('/', [TicketController::class, 'store']);
            Route::get('/{ticket}', [TicketController::class, 'show']);
            Route::put('/{ticket}', [TicketController::class, 'update']);
            Route::delete('/{ticket}', [TicketController::class, 'destroy']);
            Route::post('/{ticket}/add-message', [TicketController::class, 'addMessage']);
            Route::post('/{ticket}/update-status', [TicketController::class, 'updateStatus']);
        });

        // Notifications
        Route::prefix('notifications')->group(function () {
            Route::get('/', [NotificationController::class, 'index']);
            Route::post('/', [NotificationController::class, 'store']);
            Route::get('/{notification}', [NotificationController::class, 'show']);
            Route::delete('/{notification}', [NotificationController::class, 'destroy']);
        });
    });
});
