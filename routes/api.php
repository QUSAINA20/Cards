<?php

use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ForSaleCardController;

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
Route::group(['prefix' => 'admin/dashboard'], function($router){
    Route::post('/login', [AdminController::class , 'login']);
});


Route::group([ 'middleware' =>['jwt.role:admin' , 'auth']  , 'prefix' => 'admin/dashboard'], function($router){
    Route::post('/logout', [AdminController::class , 'logout']);
});

//User Route
Route::group(['prefix' => 'user'], function($router){
    Route::post('/register', [UserController::class , 'register']);
    Route::post('/login', [UserController::class , 'login']);
});


Route::group([ 'middleware' =>['jwt.role:user' , 'auth']  , 'prefix' => 'user'], function($router){
    Route::post('/logout', [UserController::class , 'logout']);
});


Route::post("/send-message", [MessageController::class, "store"]);
Route::get("/for-sale-cards", [ForSaleCardController::class, "index"]);
Route::get('/', [HomeController::class, 'index'])->name('home')->json();
Route::get('/buy-card/{id}', [HomeController::class, 'buyCard'])->name('buy')->json();
Route::post('/get-transaction-for-method', [HomeController::class, 'getTransactionNumber'])->name('get-transaction-for-method')->json();
Route::get('/dashboard', [HomeController::class, 'isUser'])->name('dashboard')->json();
