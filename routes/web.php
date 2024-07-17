<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
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


Route::get('/home', function () {
    return view('admin.category.admin_category_page');
});

//Route::prefix('categories')->group(function () {
//    Route::get('/category', [CategoryController::class,'index']) ->name('category');
//    Route::get('/category/add', [CategoryController::class,'add']) ->name('category.add');
//    Route::post('/category/store', [CategoryController::class,'store']) ->name('category.store');
//    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
//    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
//});

Route::get('categories/suggest', [CategoryController::class, 'suggest'])->name('categories.suggest');

Route::get('categories/paginate-limit', [CategoryController::class, 'getLimit'])->name('categories.limit');

Route::resource('categories', CategoryController::class);


