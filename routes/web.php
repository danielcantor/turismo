<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('index');
});

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
Route::get('/productos/info/{id}', [ProductController::class, 'show_product']);
Route::post('/login', [UserController::class, 'login'])->name('login');

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
    });    
});
Route::resource('/productos', ProductController::class);
//Route::get('/productos/modificar', [ProductController::class, 'modificar'])->name('productos.modificar');
//Route::delete('/productos/{id}', 'ProductosController@destroy')->name('productos.destroy');
//Route::put('productos/{id}/activar', [ProductController::class, 'activar']);
