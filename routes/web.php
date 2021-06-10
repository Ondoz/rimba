<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {

        Route::prefix('ajax')->group(function () {
            Route::post('/', [AjaxController::class, 'getProductByid'])->name('ajax.get.product');
        });

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::post('/', [ProductController::class, 'store'])->name('product.store');
            Route::get('edit/{uuid}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('update/{uuid}', [ProductController::class, 'update'])->name('product.update');
            Route::post('delete/{uuid}', [ProductController::class, 'destroy'])->name('product.destroy');
        });

        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
            Route::post('/', [CustomerController::class, 'store'])->name('customer.store');
        });

        Route::prefix('order')->group(function () {
            Route::get('/', [TransactionController::class, 'index'])->name('order.index');
            Route::post('/', [TransactionController::class, 'store'])->name('order.store');
        });
    });
});
