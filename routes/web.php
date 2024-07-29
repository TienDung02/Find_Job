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
    return view('admin.categories.admin_category_page');
});


//Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
//    Route::get('/suggest', 'suggest')->name('suggest');
//    Route::get('/paginate-limit', 'getLimit')->name('limit');
//});
//Route::resource('categories', CategoryController::class);




// Route CategoryController
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create'); // Hiển thị form thêm mới
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store'); // Lưu thêm mới
//Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show'); // Xem chi tiết
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit'); // Hiển thị form sửa
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Cập nhật
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy'); // Xóa
Route::get('categories/suggest', [CategoryController::class, 'suggest'])->name('categories.suggest');
Route::get('categories/paginate-limit', [CategoryController::class, 'getLimit'])->name('categories.limit');


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



//Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
//    Route::get('/users', 'suggest')->name('suggest');
//    Route::get('/paginate-limit', 'getLimit')->name('limit');
//});


// Route UserController
Route::patch('users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{users}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('users/suggest', [UserController::class, 'suggest'])->name('users.suggest');
Route::get('users/paginate-limit', [UserController::class, 'getLimit'])->name('users.limit');

//Route::resource('users', UserController::class);
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



