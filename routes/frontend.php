<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controllers\frontend\ResumeController;
use App\Http\Controllers\frontend\IndustryController;
use App\Http\Controllers\frontend\JobController;
use App\Http\Controllers\frontend\CompanyController;
use App\Http\Controllers\frontend\ApplicationController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\BookmarkCandidateController;
use App\Http\Controllers\frontend\BookmarkEmployerController;
use App\Http\Controllers\frontend\JobAlertController;
use App\Http\Controllers\frontend\MessagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Livewire\Chat\Index;
use App\Http\Livewire\Chat\Chat;
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

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/activate/{token}', [LoginController::class, 'activate'])->name('activate.account');


Route::middleware(['auth'])->group(function () {
    Route::any('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::any('/change-password', [LoginController::class, 'changePassword'])->name('changePassword');
    Route::any('/password/update', [LoginController::class, 'update'])->name('password.update');

    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


    /*Resume*/
    Route::get('/resume/detail/{id}', [ResumeController::class, 'detail'])->name('resume.detail');
    Route::post('/resume/store', [ResumeController::class, 'store'])->name('resume.store');
    Route::get('/resume/manage', [ResumeController::class, 'manage'])->name('resume.manage');
    Route::get('/resume/add', [ResumeController::class, 'create'])->name('resume.add');
    Route::get('/resume/edit/{id}', [ResumeController::class, 'edit'])->name('resume.edit');
    Route::put('/resume/update/{id}', [ResumeController::class, 'update'])->name('resume.update');
    Route::get('/resume/browser', [ResumeController::class, 'browser'])->name('resume.browser');
    Route::get('/resume/bookmark-resume/{id}', [ResumeController::class, 'addBookmark'])->name('resume.bookmark');
    Route::get('/resume/remove-bookmark-resume/{id}', [ResumeController::class, 'removeBookmark'])->name('resume.remove-bookmark');
    Route::get('/resume/suggest', [ResumeController::class, 'suggest'])->name('resume.suggest');
    Route::delete('/resume/delete/{id}', [ResumeController::class, 'destroy'])->name('resume.delete');
    Route::delete('/resume/delete-nwp/{id}', [ResumeController::class, 'destroy_nwp'])->name('resume.delete_nwp');
    Route::delete('/resume/delete-edu/{id}', [ResumeController::class, 'destroy_edu'])->name('resume.delete_edu');
    Route::delete('/resume/delete-exp/{id}', [ResumeController::class, 'destroy_exp'])->name('resume.delete_exp');


    /*Job*/
    Route::get('/job/alert-job', [JobAlertController::class, 'index'])->name('alert.index');
    Route::get('/job/change-active/{id}, {active}', [JobAlertController::class, 'change_active'])->name('alert.change_active');
    Route::get('/job/manage', [JobController::class, 'manage'])->name('job.manage');
    Route::get('/job/add', [JobController::class, 'create'])->name('job.add');
    Route::get('/job/edit/{id}', [JobController::class, 'edit'])->name('job.edit');
    Route::get('/job/index/{id}', [JobController::class, 'index'])->name('job.index');
    Route::post('/job/applyJob/{id}', [JobController::class, 'applyJob'])->name('job.apply');
    Route::get('/job/bookmark-job/{id}', [JobController::class, 'addBookmark'])->name('job.bookmark');
    Route::get('/job/remove-bookmark-job/{id}', [JobController::class, 'removeBookmark'])->name('job.remove-bookmark');
    Route::post('/job/store', [JobController::class, 'store'])->name('job.store');
    Route::put('/job/update/{id}', [JobController::class, 'update'])->name('job.update');
    Route::put('/job/fill/{id}', [JobController::class, 'fill'])->name('job.fill');
    Route::delete('/job/delete/{id}', [JobController::class, 'destroy'])->name('job.delete');

    /*Company*/
    Route::get('/company/add', [CompanyController::class, 'create'])->name('company.add');
    Route::get('/company/suggest', [CompanyController::class, 'suggest'])->name('company.suggest');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');
    Route::put('/company/update/{id}', [CompanyController::class, 'update'])->name('company.update');
    Route::get('/company/detail/{id}', [CompanyController::class, 'detail'])->name('company.detail');

    /*Application*/
    Route::get('/job-application/manage/{id?}', [ApplicationController::class, 'index'])->name('application.manage');
    Route::put('/job-application/update-apply/{id}', [ApplicationController::class, 'update'])->name('application.update');
    Route::get('/job-application/loadMoreApplications', [ApplicationController::class, 'loadMoreApplications'])->name('application.loadMoreApplications');
    Route::delete('/job-application/destroy/{id}', [ApplicationController::class, 'destroy'])->name('application.destroy');


    /*Blog*/
    Route::get('/home/blog/index', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/home/blog/detail/{id}', [BlogController::class, 'detail'])->name('blog.detail');
    Route::post('/home/blog/comment/{id}', [BlogController::class, 'addComment'])->name('blog.comment');
    Route::get('/home/blog/load-more', [BlogController::class, 'loadMoreComments'])->name('blog.load_more_comment');
    Route::get('/home/blog/reply', [BlogController::class, 'replyComments'])->name('blog.reply_comment');

    /*Bookmark Candidate*/
    Route::get('/bookmark_candidate', [BookmarkCandidateController::class, 'index'])->name('bookmark_candidate.index');
    Route::get('/bookmark_candidate/suggest', [BookmarkCandidateController::class, 'suggest'])->name('bookmark_candidate.suggest');
    Route::get('/bookmark_candidate/select-search', [BookmarkCandidateController::class, 'select_search'])->name('bookmark_candidate.select_search');
    Route::get('/bookmark_candidate/select2-search', [BookmarkCandidateController::class, 'select2_search'])->name('bookmark_candidate.select2_search');
    Route::get('/bookmark_candidate/checkbox-search', [BookmarkCandidateController::class, 'checkbox_search'])->name('bookmark_candidate.checkbox_search');
    Route::get('/bookmark_candidate/tag-search/{id}', [BookmarkCandidateController::class, 'tag_search'])->name('bookmark_candidate.tag_search');
    Route::get('/bookmark_candidate/browser-search', BookmarkCandidateController::class)->name('bookmark_candidate.meili');

    /*Bookmark Employer*/
    Route::get('/bookmark_employer', [BookmarkEmployerController::class, 'index'])->name('bookmark_employer.index');
    Route::get('/bookmark_employer/suggest', [BookmarkEmployerController::class, 'suggest'])->name('bookmark_employer.suggest');
    Route::get('/bookmark_employer/select-search', [BookmarkEmployerController::class, 'select_search'])->name('bookmark_employer.select_search');
    Route::get('/bookmark_employer/select2-search', [BookmarkEmployerController::class, 'select2_search'])->name('bookmark_employer.select2_search');
    Route::get('/bookmark_employer/checkbox-search', [BookmarkEmployerController::class, 'checkbox_search'])->name('bookmark_employer.checkbox_search');
    Route::get('/bookmark_employer/tag-search/{id}', [BookmarkEmployerController::class, 'tag_search'])->name('bookmark_employer.tag_search');
    Route::get('/bookmark_employer/browser-search', BookmarkEmployerController::class)->name('bookmark_employer.meili');

//    Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
//    Route::get('/messages/change', [MessagesController::class, 'change_messages'])->name('messages.change');
//    Route::get('/messages/load-mess-prev', [MessagesController::class, 'load_prev_messages'])->name('messages.load_prev');

    Route::get('/messages',Index::class)->name('chat');

//    Route::get('/chat',Index::class)->name('chat.index');
//    Route::get('/chat/{query}', Chat::class)->name('chat');
});

// Route LoginController

Route::get('login', [LoginController::class, 'index'])->name('auth.login');
Route::post('auth', [LoginController::class, 'login'])->name('auth');
Route::post('reg', [LoginController::class, 'store'])->name('auth.register');


Route::get('/home/job/detail/{id}', [JobController::class, 'detail'])->name('job.detail');

Route::get('/home/browser-job/{id?}', [JobController::class, 'browser'])->name('job.browser');
Route::get('/job/suggest', [JobController::class, 'suggest'])->name('job.suggest');
Route::get('/home/select-search-jobs', [JobController::class, 'select_search'])->name('job.select_search');
Route::get('/home/select2-search-job', [JobController::class, 'select2_search'])->name('job.select2_search');
Route::get('/home/checkbox-search-job', [JobController::class, 'checkbox_search'])->name('job.checkbox_search');
Route::get('/home/tag-search-job/{id}', [JobController::class, 'tag_search'])->name('job.tag_search');

Route::get('/home/browser-search', JobController::class)->name('job.meili');

Route::get('/home/browser-industry', [IndustryController::class, 'index'])->name('industry.browser');










