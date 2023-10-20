<?php

use App\Http\Controllers\Api\ForSaleCardController;
use App\Http\Controllers\Api\MessageController;
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


Route::post("/send-message", [MessageController::class, "store"]);
Route::get("/for-sale-cards", [ForSaleCardController::class, "index"]);
