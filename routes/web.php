<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//get => áp dụng với hiển thị ra các view
//post => thêm dữ liệu lên db
//put => sửa dữ liệu trên db
//delete => xóa dữ liệu trên db

//Tạo 1 url, khi vào url này sẽ gọi đến function login ở trong class demoController
Route::get('/login', [\App\Http\Controllers\demoController::class, 'login'])->name('login');

Route::get('/register', [\App\Http\Controllers\demoController::class, 'register'])->name('register');

Route::prefix('/brands')->group(function(){
    //Route read
    Route::get('/', [\App\Http\Controllers\BrandController::class, 'index'])->name('brands.index');
    //Route hiển thị form thêm brand
    Route::get('/create', [\App\Http\Controllers\BrandController::class, 'create'])->name('brands.create');
    //Route thêm dữ liệu lên db
    Route::post('/create', [\App\Http\Controllers\BrandController::class, 'store'])->name('brands.store');
    //Route hiển thị form sửa
    Route::get('/{brand}/edit',[\App\Http\Controllers\BrandController::class, 'edit'])->name('brands.edit');
    //Route update dữ liệu trên db
    Route::put('/{brand}/edit', [\App\Http\Controllers\BrandController::class, 'update'])->name('brands.update');
    //Route để xóa
    Route::delete('/{brand}', [\App\Http\Controllers\BrandController::class, 'destroy'])->name('brands.destroy');
});

Route::middleware('checkLoginCustomer')->prefix('/products')->group(function(){
    Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [\App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
    Route::post('/create', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}/edit', [\App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}/edit', [\App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/viewCart', [\App\Http\Controllers\ProductController::class, 'viewCart'])->name('products.viewCart');
    Route::get('/addToCart/{product}', [\App\Http\Controllers\ProductController::class, 'addToCart'])->name('products.addToCart');
    Route::get('/deleteFromCart/{id}', [\App\Http\Controllers\ProductController::class, 'deleteFromCart'])->name('products.deleteFromCart');
});

Route::get('/login-customer', [\App\Http\Controllers\CustomerController::class, 'login'])->name('customer.login');
Route::post('/login-customer', [\App\Http\Controllers\CustomerController::class, 'loginProcess'])->name('customer.loginProcess');
Route::get('/logout-customer', [\App\Http\Controllers\CustomerController::class, 'logout'])->name('customer.logout');
