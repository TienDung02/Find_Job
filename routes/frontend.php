<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\LoginController;
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
    return view('frontend.home.index');
});


// Route CategoryController
Route::get('login', [LoginController::class, 'index'])->name('login.index');
//Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
//Route::post('category', [CategoryController::class, 'store'])->name('category.store');
//Route::get('category/show', [CategoryController::class, 'show'])->name('category.show');
//Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
//Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update');
//Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
//Route::get('category/suggest', [CategoryController::class, 'suggest'])->name('category.suggest');
//Route::get('category/paginate-limit', [CategoryController::class, 'getLimit'])->name('category.limit');
//
//
//// Route CandidateController
//Route::put('candidate/update', [CandidateController::class, 'update'])->name('candidate.update');
//Route::get('candidate', [CandidateController::class, 'index'])->name('candidate.index');
//Route::get('candidate/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidate.edit');
//Route::get('candidate/suggest', [CandidateController::class, 'suggest'])->name('candidate.suggest');
//Route::get('candidate/paginate-limit', [CandidateController::class, 'getLimit'])->name('candidate.limit');
//
//// Route JobController
//Route::put('job/update', [JobController::class, 'update'])->name('job.update');
//Route::get('job', [JobController::class, 'index'])->name('job.index');
//Route::get('job/{job}/edit', [JobController::class, 'edit'])->name('job.edit');
//Route::get('job/suggest', [JobController::class, 'suggest'])->name('job.suggest');
//Route::get('job/paginate-limit', [JobController::class, 'getLimit'])->name('job.limit');
//
//
//// Route CompanyController
//Route::put('company/update', [CompanyController::class, 'update'])->name('company.update');
//Route::get('company', [CompanyController::class, 'index'])->name('company.index');
//Route::get('company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
//Route::get('company/suggest', [CompanyController::class, 'suggest'])->name('company.suggest');
//Route::get('company/paginate-limit', [CompanyController::class, 'getLimit'])->name('company.limit');
//
//
//
//// Route UserController
//Route::put('user/update', [UserController::class, 'update'])->name('user.update');
//Route::get('user', [UserController::class, 'index'])->name('user.index');
//Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
//Route::get('user/suggest', [UserController::class, 'suggest'])->name('user.suggest');
//Route::get('user/paginate-limit', [UserController::class, 'getLimit'])->name('user.limit');
//
//// Route BlogController
//Route::put('blog/update/{id_blog}', [BlogController::class, 'update'])->name('blog.update');
//Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
//Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
//Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
//
//Route::get('blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
//Route::get('blog/suggest', [BlogController::class, 'suggest'])->name('blog.suggest');
//Route::get('blog/paginate-limit', [BlogController::class, 'getLimit'])->name('blog.limit');
//Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy'); // Xóa



