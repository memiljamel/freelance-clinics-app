<?php

use App\Http\Controllers\Auth\ForgotController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home.index')->name('home.index');

Route::middleware('guest')->group(function () {
  Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::post('login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('forgot-password', [ForgotController::class, 'index'])->name('forgot.index');
    Route::post('forgot-password/email', [ForgotController::class, 'email'])->name('forgot.email');
    Route::get('reset-password', [ResetController::class, 'index'])->name('reset.index');
    Route::post('reset-password', [ResetController::class, 'recovery'])->name('reset.recovery');
  });
});

Route::middleware('auth')->group(function () {
  Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
  Route::get('dashboard', DashboardController::class)->name('dashboard.index');
  Route::resource('patients', PatientController::class)->except('show');
  Route::get('forms/{patient}/edit', [FormsController::class, 'edit'])->name('forms.edit');
  Route::patch('forms/{patient}', [FormsController::class, 'update'])->name('forms.update');
  Route::resource('doctors', DoctorController::class)->except('show');
  Route::resource('users', UserController::class)->except('show');

  Route::prefix('auth')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');
  });
});
