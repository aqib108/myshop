<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;



//function Category Routes

//end of category routes
Route::get('category', [CategoryController::class, 'index']);
Route::post('save', [CategoryController::class, 'store']);

