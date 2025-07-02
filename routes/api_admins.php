<?php



use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Api\Admin\Service\ServiceController;
use App\Http\Controllers\Api\Admin\Setting\SettingController;
use App\Http\Controllers\Api\Admin\User\UserController;
use App\Http\Controllers\Api\Admin\Authentication\AuthController;
use App\Http\Controllers\Api\Admin\Banner\BannerController;
use App\Http\Controllers\Api\Admin\Notification\NotificationController;
use App\Http\Controllers\Api\Admin\Ticket\TicketController;
use App\Http\Controllers\Api\Admin\Visit\VisitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/admins', 'middleware' => ['localization']], function () {

    // Auth Routes
    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:admin');
        Route::post('/refresh', [AuthController::class, 'refreshToken'])->middleware('auth:admin');
    });

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {

        // Users
        Route::prefix('users')->group(function () {
            Route::get('trashed', [UserController::class, 'trashed']);
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{user}', [UserController::class, 'show']);
            Route::put('/{user}', [UserController::class, 'update']);
            Route::delete('/{user}', [UserController::class, 'destroy']);
        });

        // Visits
        Route::prefix('visits')->group(function () {
            Route::get('/', [VisitController::class, 'index']);
            Route::post('/', [VisitController::class, 'store']);
            Route::get('/{visit}', [VisitController::class, 'show']);
            Route::put('/{visit}', [VisitController::class, 'update']);
            Route::delete('/{visit}', [VisitController::class, 'destroy']);
        });

        // Services
        Route::prefix('services')->group(function () {
            Route::get('/', [ServiceController::class, 'index']);
            Route::post('/', [ServiceController::class, 'store']);
            Route::get('/{service}', [ServiceController::class, 'show']);
            Route::put('/{service}', [ServiceController::class, 'update']);
            Route::delete('/{service}', [ServiceController::class, 'destroy']);
            Route::get('trashed', [ServiceController::class, 'trashed']);
            Route::post('restore/{service}', [ServiceController::class, 'restore']);
        });

        // Reports
        Route::prefix('reports')->group(function () {
            Route::get('/{visit}/attributes', [ReportController::class, 'get_report_attributes']);
            Route::post('/{visit}', [ReportController::class, 'store_report']);
            Route::get('/{visit}/generate-report', [ReportController::class, 'generateReport']);
            Route::put('/{visit}', [ReportController::class, 'update_report']);
            Route::get('/{visit}', [ReportController::class, 'get_report']);
            Route::delete('{visit}', [ReportController::class, 'delete_report']);
        });

        // Banners
        Route::prefix('banners')->group(function () {
            Route::get('/', [BannerController::class, 'index']);
            Route::post('/', [BannerController::class, 'store']);
            Route::get('/{banner}', [BannerController::class, 'show']);
            Route::put('/{banner}', [BannerController::class, 'update']);
            Route::delete('/{banner}', [BannerController::class, 'destroy']);
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
