<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AuthController;

// 1. Weather & Login Page (Step 3 in Lab Manual 8)
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 2. Realtime Weather API (Required for the Script in Step 5)
Route::get('/weather', [AuthController::class, 'getWeather']);

// 3. Registration Routes
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

// 4. Authenticated Dashboard & Notes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [NoteController::class, 'dashboard'])->name('dashboard');
    Route::post('/notes', [NoteController::class, 'store']);
    Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});