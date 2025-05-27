<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VpsController;
use App\Http\Controllers\VpsPackageController;
use App\Http\Controllers\WalletController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::get('/vps-packages', [VpsPackageController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/vps', [VpsController::class, 'create']);
    Route::get('/vps', [VpsController::class, 'index']);
    Route::post('/wallet/topup', [WalletController::class, 'topup']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
