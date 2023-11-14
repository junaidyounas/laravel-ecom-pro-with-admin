<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CustomAuthController;

use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\RoutePath;
use Laravel\Fortify\Features;

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
Auth::routes();


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/shops', [ShopController::class, 'index']);
    Route::post('/shops/{user}/activate', [CustomAuthController::class, 'activate']);
    Route::post('/shops/{user}/deactivate',[CustomAuthController::class, 'deactivate']);
});


Route::get('/user/login', [CustomAuthController::class, 'show_user_login']);
Route::post('/user/login', [CustomAuthController::class, 'user_login'])->name('user.login');

Route::get('/', [CustomAuthController::class, 'redirect']);
Route::get('/register/shop', [CustomAuthController::class, 'view_register']);
route::post('/register/shop', [CustomAuthController::class, 'create'])->name('register/shop');
Route::get('/product_detail/{id}', [HomeController::class, 'product_detail']);
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/all_products', [AdminController::class, 'all_products']);

Route::get('/orders', [OrderController::class, 'all_orders']);

Route::get('/order_detail/{id}', [OrderController::class, 'single_order'])->name('pages.single_order');
Route::post('/update_order_status/{order}', [OrderController::class, 'update_order_status']);


Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);
Route::post('/confirm_update_product/{id}', [AdminController::class, 'confirm_update_product']);
Route::delete('/delete-image/{id}', [ImageController::class, 'deleteImage']);

Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'add']);
Route::post('/cart/remove/{id}', [CartController::class, 'remove']);
Route::get('/checkout', 'OrderController@index')->name('checkout.index');
Route::post('/checkout', 'OrderController@store')->name('checkout.store');
Route::post('/place-order', [OrderController::class, 'place_order']);
// Route::get('/order-confirmation', [OrderController::class, 'confirmation']);
Route::get('/order-confirmation/{reference}', [OrderController::class, 'confirmation'])->name('order.confirmation');

