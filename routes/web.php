<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
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


Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
    Route::get('/suggest', 'suggest')->name('suggest');
    Route::get('/paginate-limit', 'getLimit')->name('limit');
});
Route::resource('categories', CategoryController::class);

Route::prefix('candidate')->name('candidate.')->controller(CandidateController::class)->group(function () {
    Route::get('/suggest', 'suggest')->name('suggest');
    Route::get('/paginate-limit', 'getLimit')->name('limit');
});
Route::resource('candidate', CandidateController::class);

Route::prefix('job')->name('job.')->controller(JobController::class)->group(function () {
    Route::get('/job', 'suggest')->name('suggest');
    Route::get('/paginate-limit', 'getLimit')->name('limit');
});
Route::resource('job', JobController::class);

Route::prefix('company')->name('company.')->controller(CompanyController::class)->group(function () {
    Route::get('/job', 'suggest')->name('suggest');
    Route::get('/paginate-limit', 'getLimit')->name('limit');
});
Route::resource('company', CompanyController::class);

Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
    Route::get('/user', 'suggest')->name('suggest');
    Route::get('/paginate-limit', 'getLimit')->name('limit');
});
Route::resource('user', UserController::class);

Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
    Route::get('/blog', 'suggest')->name('suggest');
    Route::get('/paginate-limit', 'getLimit')->name('limit');
});
Route::resource('blog', BlogController::class);



