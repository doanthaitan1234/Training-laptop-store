<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LangController;
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

Auth::routes();
Route::get('/admin', [HomeController::class, 'index']);

Route::controller(HomepageController::class)->group(function () {
    Route::get('/home','index')->name('home');
    Route::get('/product','productPage')->name('product');
    Route::get('/get-products','getProducts')->name('getProductsAjax');
    Route::get('/product/{id}', 'getProductDetail')->name('product.detail');
    Route::get('/','index');
    Route::get('/get-product-images-ajax', 'getProductImagesAjax');
    Route::get('/sort-products', 'sortProducts')->name('sort');
    Route::get('/get-cart', 'getCart')->name('cart.list');
    Route::post('/add-to-cart','addToCart')->name('cart.add');
    Route::post('/update-cart','updateCart')->name('cart.update');
    // Route::get('/error','error')->name('error');
 });

Route::prefix('admin')->middleware(['CheckAdmin'])->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);

    Route::get('ajax-user-datatable', [UserController::class, 'getUserList'])->name('users.list');
    Route::post('change-status-user', [UserController::class, 'changeStatus'])->name('users.changeStatus');

    Route::get('ajax-category-datatable', [CategoryController::class, 'getCategoryList'])->name('categories.list');

    Route::get('ajax-product-datatable', [ProductController::class, 'getProductList'])->name('products.list');
    Route::get('ajax-product-detail', [ProductController::class, 'getProductAjax'])->name('products.getOne');
    Route::post('change-status-product', [ProductController::class, 'changeStatus'])->name('products.changeStatus');

    Route::get('get-orders', [OrderController::class, 'getOrders'])->name('orders.list');
    Route::post('update-order-quantity', [OrderController::class, 'updateOrderQuantity'])->name('orders.updateQuantity');
    Route::get('confirm-order/{id}', [OrderController::class, 'confirmOrder'])->name('orders.confirm');
    Route::patch('update-order-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('cancel-order/{id}', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
    Route::patch('users/{id}/update', [UserController::class, 'updateUser'])->name('users.updateUser');
});
Route::get('lang/{language}', [LangController::class, 'changeLanguage'])->name('lang');

Route::middleware(['CheckUser'])->group(function () {
    Route::get('cart-list', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/add-order', [HomepageController::class, 'addOrder'])->name('order.add');
    Route::get('/my-profile', [HomepageController::class, 'profile'])->name('myProfile');
    Route::post('/change-password', [HomepageController::class, 'changePassword'])->name('changePassword');
    Route::post('/vote-product/{id}', [HomepageController::class, 'voteProduct'])->name('voteProduct');
});