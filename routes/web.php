<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{uuid}', [ProductController::class, 'show'])->name('product.show');