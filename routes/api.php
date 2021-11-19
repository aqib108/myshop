<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


//function Category Routes

//end of category routes
Route::get('category', [CategoryController::class, 'index']);
Route::post('save', [CategoryController::class, 'store']);
//products
Route::post('product-save', [ProductController::class, 'store']);
//end of products

