<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;

Route::get('/trang-chu', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    abort(403, 'Không có quyền truy cập.');
})->middleware(['auth', 'verified', 'admin']);
Route::get('/dashboard', function () {
    return redirect('/san-pham'); // hoặc /san-pham nếu bạn muốn
})->middleware(['auth'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// backend
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// product

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/products/create', [ProductController::class, 'create']);
Route::post('/admin/products', [ProductController::class, 'store']);
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);
Route::post('/admin/products/{id}/update', [ProductController::class, 'update']);
Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy']);

// admin them san pham
Route::get('/san-pham', [ProductController::class, 'showProducts']);
require __DIR__.'/auth.php';

// cart
Route::post('/them-gio-hang/{id}', [CartController::class, 'addToCart'])->middleware('auth')->name('cart.add');

Route::get('/gio-hang', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/gio-hang/xoa/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/gio-hang/cap-nhat', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::get('/thanh-toan', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/cart/update-quantity', [CartController::class, 'ajaxUpdateQuantity'])->name('cart.ajax.update');
