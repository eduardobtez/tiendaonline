<?php

use Illuminate\Support\Facades\Route;

// Controladores
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\VarianteController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TipoProductoController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Login / Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Logout   
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Productos
    Route::resource('productos', ProductoController::class)->except(['show']);

    // Clientes
    Route::resource('cliente', ClienteController::class);

    // Pedidos
    Route::resource('pedidos', PedidoController::class);

    // Envíos
    Route::resource('envio', EnvioController::class);

    // Variantes
    Route::resource('variantes', VarianteController::class);

    // Categorías con PK personalizada
    Route::resource('categorias', CategoriaController::class)
        ->parameters(['categorias' => 'categoria:id']);

    // Tipos de Producto con PK personalizada
    Route::resource('tipoproductos', TipoProductoController::class)
        ->parameters(['tipoproductos' => 'tipoproducto:id']);

    // Pagos
    Route::resource('pagos', PagoController::class); 
        
});

