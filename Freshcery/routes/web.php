<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//products 
Route::get('products/category/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleCategory'])->name('single.category');
Route::get('products/single-product/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleProduct'])->name('single.product');
Route::get('products/shop/', [App\Http\Controllers\Products\ProductsController::class, 'shop'])->name('products.shop');

//cart
Route::post('products/add-cart/', [App\Http\Controllers\Products\ProductsController::class, 'addToCart'])->name('products.add.cart');
Route::get('products/cart/', [App\Http\Controllers\Products\ProductsController::class, 'cart'])->name('products.cart');
Route::get('products/delete-cart/{id}', [App\Http\Controllers\Products\ProductsController::class, 'deleteFromCart'])->name('products.cart.delete');

//checkout and payment
Route::post('products/prepare-checkout', [App\Http\Controllers\Products\ProductsController::class, 'prepareCheckout'])->name('products.prepare.checkout');
Route::get('products/checkout', [App\Http\Controllers\Products\ProductsController::class, 'checkout'])->name(name: 'products.checkout');
Route::post('products/checkout', [App\Http\Controllers\Products\ProductsController::class, 'processCheckout'])->name(name: 'products.process.checkout');
Route::get('products/pay', [App\Http\Controllers\Products\ProductsController::class, 'payWithGcash'])->name(name: 'products.pay');

//users pages
Route::get('users/my-orders', [App\Http\Controllers\Users\UsersController::class, 'myOrders'])->name(name: 'users.orders');
Route::get('users/settings', [App\Http\Controllers\Users\UsersController::class, 'settings'])->name(name: 'users.settings');




