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

// Route::get('/', function () {
//     return view('Userside');
// });

Auth::routes();
Route::middleware(['web'])->group(function () {
  Route::get('/{vue_capture?}',function(){
    return view('admin_home');
  })->where('vue_capture','[\/\w\.-]*');
});
// Route::get('/{vue_capture?}',function(){
//     return view('admin_home');
//   })->where('vue_capture','[\/\w\.-]*');
// Route::get('/{any?}',[App\Http\Controllers\HomeController::class, 'index'])->where('any', '^(?!home).*$');
//Route::get('/{any?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->where('any', '^(?!home).*$');


