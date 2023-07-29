<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Client\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('layouts.admin');
    });
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::get('/product-deleted', [ProductController::class, 'product_deleted'])->name('products.deleted');
    Route::get('/product-restore/{id}', [ProductController::class, 'restore'])->name('products.restore');
    Route::get('/product-delete/{id}', [ProductController::class, 'deleted'])->name('product.delete');
    Route::resource('/coupons', CouponController::class);
    Route::get('orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::post('update-status/{id}', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update_status');
    Route::get('bill-detail/{id}',[AdminOrderController::class,'bill_detail'])->name('bill.detail');
    Route::resource('roles', RoleController::class);
});
Route::prefix('/')->group(function () {
    Route::get('/',  [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/product',  [ClientProductController::class, 'index'])->name('product');
    Route::get('product/{category_id}', [ClientProductController::class, 'category_product'])->name('client.products.categoryid');
    Route::get('product-detail/{id}', [ClientProductController::class, 'show'])->name('client.product.show');
});
Route::middleware('auth')->group(function () {
    Route::post('add-to-cart', [CartController::class, 'store'])->name('client.carts.add');
    Route::get('carts', [CartController::class, 'index'])->name('client.carts.index');
    Route::post('update-quantity-product-in-cart/{cart_product_id}', [CartController::class, 'updateQuantityProduct'])->name('client.carts.update_product_quantity');
    Route::post('remove-product-in-cart/{cart_product_id}', [CartController::class, 'removeProductInCart'])->name('client.carts.remove_product');
    Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('client.carts.apply_coupon');
    Route::get('checkout', [CartController::class, 'checkout'])->name('client.checkout.index');
    Route::post('process-checkout', [CartController::class, 'processCheckout'])->name('client.checkout.proccess');
});
Auth::routes();

