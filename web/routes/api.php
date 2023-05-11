<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FormsController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\ResetController;
use App\Http\Controllers\Api\Auth\ChangeController;
use App\Http\Controllers\Api\Auth\ForgotController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;

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

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
    Route::post('forgot-password', ForgotController::class);
    Route::post('reset-password', ResetController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('doctors', DoctorController::class);
    Route::post('patients', PatientController::class);
    Route::get('forms/{user}', FormsController::class);
    Route::patch('users/{user}', UserController::class);

    Route::prefix('auth')->group(function () {
        Route::patch('change-password/{user}', ChangeController::class);
        Route::post('logout', LogoutController::class);
    });
});
