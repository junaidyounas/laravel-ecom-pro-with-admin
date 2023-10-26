<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/signin', 'Auth\LoginController@showLoginForm')->name('login');
route::get('/', [HomeController::class, 'redirect']);
route::get('/product_detail/{id}', [HomeController::class, 'product_detail']);
route::get('/view_category', [AdminController::class, 'view_category']);
route::post('/add_category', [AdminController::class, 'add_category']);
route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
route::get('/view_product', [AdminController::class, 'view_product']);
route::post('/add_product', [AdminController::class, 'add_product']);
route::get('/all_products', [AdminController::class, 'all_products']);

route::get('/orders', [OrderController::class, 'all_orders']);

Route::get('/order_detail/{id}', [OrderController::class, 'single_order'])->name('pages.single_order');
Route::post('/update_order_status/{order}', [OrderController::class, 'update_order_status']);


route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);
route::post('/confirm_update_product/{id}', [AdminController::class, 'confirm_update_product']);
route::delete('/delete-image/{id}', [ImageController::class, 'deleteImage']);
 
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']);
Route::get('/checkout', 'OrderController@index')->name('checkout.index');
Route::post('/checkout', 'OrderController@store')->name('checkout.store');
Route::post('/place-order', [OrderController::class, 'place_order']);
// Route::get('/order-confirmation', [OrderController::class, 'confirmation']);
Route::get('/order-confirmation/{reference}', [OrderController::class, 'confirmation'])->name('order.confirmation');

