<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controllers\frontend\ResumeController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\JobController;
use App\Http\Controllers\frontend\CompanyController;
use App\Http\Controllers\frontend\ApplicationController;
use App\Http\Controllers\frontend\BlogController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home.index');


Route::middleware(['auth'])->group(function () {
    Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::any('/change-password', [LoginController::class, 'changePassword'])->name('changePassword');

    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');
    Route::get('/resume/manage', [ResumeController::class, 'manage'])->name('resume.manage');
    Route::get('/resume/add', [ResumeController::class, 'create'])->name('resume.add');
    Route::get('/resume/browser', [ResumeController::class, 'browser'])->name('resume.browser');

    Route::get('/home/browser-category', [CategoryController::class, 'index'])->name('category.browser');

    Route::get('/home/browser-job', [JobController::class, 'browser'])->name('job.browser');
    Route::get('/home/alert-job', [JobController::class, 'alert'])->name('job.alert');
    Route::get('/job/manage', [JobController::class, 'manage'])->name('job.manage');
    Route::get('/job/add', [JobController::class, 'create'])->name('job.add');
    Route::get('/job/index/{id}', [JobController::class, 'index'])->name('job.index');
    Route::get('/job/detail/{id}', [JobController::class, 'detail'])->name('job.detail');

    Route::get('/company/add', [CompanyController::class, 'index'])->name('company.add');

    Route::get('/job-application/manage', [ApplicationController::class, 'index'])->name('application.manage');

    Route::get('/home/blog/index', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/home/blog/detail/{id}', [BlogController::class, 'detail'])->name('blog.detail');
});

// Route LoginController
Route::post('login', [LoginController::class, 'login'])->name('auth.login');













//Route::get('confirm', [LoginController::class, 'confirm'])->name('login.confirm');
//Route::get('email', [LoginController::class, 'email'])->name('login.email');
//Route::get('reset', [LoginController::class, 'reset'])->name('login.reset');
//Route::get('login', [LoginController::class, 'index'])->name('login');
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



