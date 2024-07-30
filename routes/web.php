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
    return view('backend.category.admin_category_page');
});


//Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
//    Route::get('/suggest', 'suggest')->name('suggest');
//    Route::get('/paginate-limit', 'getLimit')->name('limit');
//});
//Route::resource('category', CategoryController::class);




// Route CategoryController
Route::get('category', [CategoryController::class, 'index'])->name('category.index');
Route::get('category/create', [CategoryController::class, 'create'])->name('category.create'); // Hiển thị form thêm mới
Route::post('category', [CategoryController::class, 'store'])->name('category.store'); // Lưu thêm mới
//Route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show'); // Xem chi tiết
Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit'); // Hiển thị form sửa
Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update'); // Cập nhật
Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy'); // Xóa
Route::get('category/suggest', [CategoryController::class, 'suggest'])->name('category.suggest');
Route::get('category/paginate-limit', [CategoryController::class, 'getLimit'])->name('category.limit');


// Route CandidateController
Route::put('candidate/update', [CandidateController::class, 'update'])->name('candidate.update');
Route::get('candidate', [CandidateController::class, 'index'])->name('candidate.index');
Route::get('candidate/{candidate}/edit', [CandidateController::class, 'edit'])->name('candidate.edit');
Route::get('candidate/suggest', [CandidateController::class, 'suggest'])->name('candidate.suggest');
Route::get('candidate/paginate-limit', [CandidateController::class, 'getLimit'])->name('candidate.limit');



// Route JobController
Route::put('job/update', [JobController::class, 'update'])->name('job.update');
Route::get('job', [JobController::class, 'index'])->name('job.index');
Route::get('job/{job}/edit', [JobController::class, 'edit'])->name('job.edit');
Route::get('job/suggest', [JobController::class, 'suggest'])->name('job.suggest');
Route::get('job/paginate-limit', [JobController::class, 'getLimit'])->name('job.limit');


//Route::resource('job', JobController::class);
//
//Route::prefix('company')->name('company.')->controller(CompanyController::class)->group(function () {
//    Route::get('/suggest', 'suggest')->name('suggest');
//    Route::get('/paginate-limit', 'getLimit')->name('limit');
//});


// Route CompanyController
Route::put('company/update', [CompanyController::class, 'update'])->name('company.update');
Route::get('company', [CompanyController::class, 'index'])->name('company.index');
Route::get('company/{company}/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::get('company/suggest', [CompanyController::class, 'suggest'])->name('company.suggest');
Route::get('company/paginate-limit', [CompanyController::class, 'getLimit'])->name('company.limit');

//Route::resource('company', CompanyController::class);
//



//Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
//    Route::get('/user', 'suggest')->name('suggest');
//    Route::get('/paginate-limit', 'getLimit')->name('limit');
//});


// Route UserController
Route::patch('user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::get('user/suggest', [UserController::class, 'suggest'])->name('user.suggest');
Route::get('user/paginate-limit', [UserController::class, 'getLimit'])->name('user.limit');

//Route::resource('user', UserController::class);
//
//Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
//    Route::get('/blog', 'suggest')->name('suggest');
//    Route::get('/paginate-limit', 'getLimit')->name('limit');
//});
//Route::resource('blog', BlogController::class);


// Route BlogController
Route::patch('blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
Route::get('blog', [BlogController::class, 'index'])->name('blog.index');

Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::get('blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::get('blog/suggest', [BlogController::class, 'suggest'])->name('blog.suggest');
Route::get('blog/paginate-limit', [BlogController::class, 'getLimit'])->name('blog.limit');
Route::delete('blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy'); // Xóa



