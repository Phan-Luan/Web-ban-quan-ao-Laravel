<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
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
});
Route::prefix('/')->group(function () {
    Route::get('/',  [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/product',  [ClientProductController::class, 'index'])->name('product');
    Route::get('product/{category_id}', [ClientProductController::class, 'category_product'])->name('client.products.categoryid');
    Route::get('product-detail/{id}', [ClientProductController::class, 'show'])->name('client.product.show');
});

Auth::routes();
Route::get('/test',function(){
    return view('clients.cart.shopping-cart');
});