<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinoController;
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

Route::get('/', [IndexController::class, 'index']);

Route::get('/crearProducto', function () {
    return view('productos.create');
});
Route::get('/login', function(){
    return view('users.login');
});
Route::get('/register', function(){
    return view('users.register');
});

Route::post('/productos', [ProductController::class, 'store'])->name('productos.store');
Route::delete('/deleteProducto/{id}', [ProductController::class, 'eliminar'])->name('producto.eliminar');
Route::get('/obtenerProducto/{id}', [ProductController::class, 'obtenerProducto'])->name('producto.obtenerProducto');
Route::post('/modificarProducto/{id}', [ProductController::class, 'modificarProducto'])->name('producto.modificar');
Route::post('/activarDesactivarProducto/{id}', [ProductController::class, 'activarDesactivarProducto'])->name('producto.activarDesactivarProducto');
Route::get('/productos/info/{id}', [ProductController::class, 'show_product']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/registernow', [UserController::class, 'registernow'])->name('registernow');
Route::get('/nosotros', function () {
    return view('nosotros');
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::controller(DestinoController::class)->group(function () {
    Route::prefix('destinos')->group(function () {
        Route::get('/nacional', 'nacional');
        Route::get('/internacional', 'internacional');
        Route::get('/aereo', 'aereo');
        Route::get('/escapada', 'escapada');
        Route::get('/finde', 'finde');
    });    
});
Route::resource('/productos', ProductController::class);
Route::get('/checkout', function () {
    return view('checkout');
});