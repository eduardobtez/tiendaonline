<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Ruta de logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Ruta protegida de ejemplo
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

use App\Http\Controllers\ProductoController;

Route::middleware(['auth'])->group(function () {
    Route::resource('productos', ProductoController::class)->except(['show']);
});

use App\Http\Controllers\ClienteController;

Route::resource('cliente', ClienteController::class)->middleware('auth');

