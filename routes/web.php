<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArtisanController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
    Route::controller(ProductController::class)->group(function () {
        Route::prefix('products')->group(function () {
            Route::get('/list', 'modificar');
            Route::post('/save', 'store');
            Route::get('/get', 'get');
            Route::delete('/delete/{id}', 'eliminar');
            Route::get('/obtenerProducto/{id}','obtenerProducto');
            Route::post('/update/{id}', 'modificarProducto');
            Route::post('/toggle/{id}','activarDesactivarProducto');
        });    
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::prefix('category')->group(function () {
            Route::get('/list', 'index');
            Route::post('/save', 'store');
            Route::get('/get', 'getCategories');
            Route::get('/get/{category}', 'show');
            Route::put('/update/{category}', 'update');
            Route::delete('/delete/{category}', 'destroy');
        });    
    });
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

Route::prefix('destinos')->group(function () {
    Route::get('/{slug}', [DestinoController::class, 'show'])->name('destino.{slug}');
}); 

Route::get('/admin/status', function () {
    return response()->json(['authenticated' => Auth::guard('admin')->check()]);
});

Route::get('/checkout/{id}', [ShoppingController::class, 'index']);
Route::get('/success/{purchase_id}', [ShoppingController::class, 'success']);
Route::get('/failure/{purchase_id}', [ShoppingController::class, 'failure']);
Route::get('/pending/{purchase_id}', [ShoppingController::class, 'pending']);
Route::post('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/mail', [IndexController::class, 'mail'])->name('mail');

Route::get('/migrate', [ArtisanController::class, 'migrate']);
Route::get('/seed-categories', [ArtisanController::class, 'seedCategories']);