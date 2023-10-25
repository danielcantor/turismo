<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Artisan;
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
Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/crearProducto', function () {
        return view('productos.create');
    })->name('productos.create');
    
    Route::get('/productos', [ProductController::class, 'modificar'])->name('productos.modificar1');
});

Route::get('/login', function(){
    return view('users.login');
});
Route::get('/register', function(){
    return view('users.register');
});
Route::get('/link', function(){
    return Artisan::call('storage:link');
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
Route::get('/adminpass', [IndexController::class, 'changePassword']);

Route::controller(DestinoController::class)->group(function () {
    Route::prefix('destinos')->group(function () {
        Route::get('/nacional', 'nacional');
        Route::get('/internacional', 'internacional');
        Route::get('/aereo', 'aereo');
        Route::get('/escapada', 'escapada');
        Route::get('/finde', 'finde');
    });    
});


Route::get('/checkout/{id}', [ShoppingController::class, 'index']);
Route::get('/success/{purchase_id}', [ShoppingController::class, 'success']);
Route::get('/failure/{purchase_id}', [ShoppingController::class, 'failure']);
Route::get('/pending/{purchase_id}', [ShoppingController::class, 'pending']);
Route::post('/cart', [CartController::class, 'getMercadoPago'])->name('cart');
Route::post('/mail', [IndexController::class, 'mail'])->name('mail');