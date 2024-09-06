<?php

use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\CandidateController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CompanyController;
use App\Http\Controllers\backend\JobController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\MessagesController;
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


//Route::get('/home', function () {
//    return view('backend.dashboard.index');
//});

Route::prefix('admin')->group(function () {

// Route CategoryController
    Route::get('category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/show', [CategoryController::class, 'show'])->name('admin.category.show');
    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('category/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    Route::get('category/suggest', [CategoryController::class, 'suggest'])->name('admin.category.suggest');
    Route::get('category/paginate-limit', [CategoryController::class, 'getLimit'])->name('admin.category.limit');


// Route CandidateController
    Route::put('candidate/update', [CandidateController::class, 'update'])->name('admin.candidate.update');
    Route::get('candidate', [CandidateController::class, 'index'])->name('admin.candidate.index');
    Route::get('candidate/{candidate}/edit', [CandidateController::class, 'edit'])->name('admin.candidate.edit');
    Route::get('candidate/suggest', [CandidateController::class, 'suggest'])->name('admin.candidate.suggest');
    Route::get('candidate/paginate-limit', [CandidateController::class, 'getLimit'])->name('admin.candidate.limit');

// Route JobController
    Route::put('job/update', [JobController::class, 'update'])->name('admin.job.update');
    Route::get('job', [JobController::class, 'index'])->name('admin.job.index');
    Route::get('job/{job}/edit', [JobController::class, 'edit'])->name('admin.job.edit');
    Route::get('job/suggest', [JobController::class, 'suggest'])->name('admin.job.suggest');
    Route::get('job/paginate-limit', [JobController::class, 'getLimit'])->name('admin.job.limit');


// Route CompanyController
    Route::put('company/update', [CompanyController::class, 'update'])->name('admin.company.update');
    Route::get('company', [CompanyController::class, 'index'])->name('admin.company.index');
    Route::get('company/{company}/edit', [CompanyController::class, 'edit'])->name('admin.company.edit');
    Route::get('company/suggest', [CompanyController::class, 'suggest'])->name('admin.company.suggest');
    Route::get('company/paginate-limit', [CompanyController::class, 'getLimit'])->name('admin.company.limit');



// Route UserController
    Route::put('user/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::get('user/suggest', [UserController::class, 'suggest'])->name('admin.user.suggest');
    Route::get('user/paginate-limit', [UserController::class, 'getLimit'])->name('admin.user.limit');

// Route BlogController
    Route::put('blog/update/{id_blog}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::get('blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('blog', [BlogController::class, 'store'])->name('admin.blog.store');

    Route::get('blog/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::get('blog/suggest', [BlogController::class, 'suggest'])->name('admin.blog.suggest');
    Route::get('blog/paginate-limit', [BlogController::class, 'getLimit'])->name('admin.blog.limit');
    Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('admin.blog.destroy'); // Xóa

    Route::get('/messages', [MessagesController::class, 'index'])->name('admin.messages.index');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
