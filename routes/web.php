<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

// frontend
Route::get('/', function () {
    return view('welcome');
});
// backend
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');

// product

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/products/create', [ProductController::class, 'create']);
Route::post('/admin/products', [ProductController::class, 'store']);
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']);
Route::post('/admin/products/{id}/update', [ProductController::class, 'update']);
Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy']);

// admin them san pham
Route::get('/san-pham', [ProductController::class, 'showProducts']);
require __DIR__.'/auth.php';
