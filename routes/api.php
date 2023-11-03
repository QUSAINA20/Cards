<?php

use App\Http\Controllers\Api\Admin\CardValueController as AdminCardValueController;
use App\Http\Controllers\Api\Admin\SaleController as AdminSaleController;


use App\Http\Controllers\Api\CardTypeController;

use App\Http\Controllers\Api\Admin\CardTypeController as AdminCardTypeController;
use App\Http\Controllers\Api\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ForSaleCardController;
use App\Http\Controllers\Api\SaleController;
use App\Models\Admin;

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

//Admin Route
Route::group(['prefix' => 'admin/dashboard'], function ($router) {
    Route::post('/login', [AdminController::class, 'login']);
});










Route::group(['middleware' => ['jwt.role:admin', 'auth'], 'prefix' => 'admin/dashboard'], function ($router) {

    Route::get('/sales', [AdminSaleController::class, 'index']);
    Route::post('/change-sale-statuse/{id}', [AdminSaleController::class, 'changeStatus']);
    Route::delete('/remove-sale/{id}', [AdminSaleController::class, 'destroy']);

    Route::controller(AdminCardTypeController::class)->group(function () {

        Route::get('card-types',  'index');
        Route::post('card-types/store', 'store');
        Route::put('card-types/{cardType}',  'update');
        Route::delete('card-types/{cardType}', 'destroy');
        Route::put('card-types/{cardType}/changestatus',  'changeStatus');
    });


    Route::controller(AdminCardValueController::class)->group(function () {
        Route::post('card-values/store', 'store');
        Route::put('card-values/{cardValue}',  'update');
        Route::delete('card-values/{cardValue}', 'destroy');
        Route::put('card-values/{cardValue}/changestatus',  'changeStatus');
    });

    Route::get('guests/messages', [AdminMessageController::class, 'getGuestsMessages']);
    Route::get('guests/messages/{id}', [AdminMessageController::class, 'getGuestMessage']);
    Route::get('users/messages', [AdminMessageController::class, 'getUsersMessages']);
    Route::get('users/messages/{id}', [AdminMessageController::class, 'getUserMessage']);
    Route::put('guests/messages/{id}/update-status', [AdminMessageController::class, 'updateGuestStatusMessage']);
    Route::put('users/messages/{id}/update-status', [AdminMessageController::class, 'updateUserStatusMessage']);
    Route::post('guests/messages/{id}/reply', [AdminMessageController::class, 'replayToGuest']);
    Route::post('users/messages/{id}/reply', [AdminMessageController::class, 'replayToUser']);

    Route::post('/logout', [AdminController::class, 'logout']);
});

//User Route
Route::group(['prefix' => 'user'], function ($router) {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});


Route::group(['middleware' => ['jwt.role:user', 'auth'], 'prefix' => 'user'], function ($router) {
    Route::post('/logout', [UserController::class, 'logout']);
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post("/send-message", [MessageController::class, "store"]);

Route::get("/for-sale-cards", [ForSaleCardController::class, "index"]);
Route::get('/for-sale-cards/{forSaleCard}', [ForSaleCardController::class, "show"]);

Route::post("/buy-card", [SaleController::class, "store"]);
