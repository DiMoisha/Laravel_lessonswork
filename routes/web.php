<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FeedbackController;

use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FeedsourceController as AdminFeedsourceController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;


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

Route::get('/welcome', function () {
    return view('welcome');
});


// home routes
Route::group(['prefix' => '', 'as' => 'home.'], function () {
    Route::get('/', [HomeController::class, 'index'])
        ->name('index');
    Route::get('/hello', [HomeController::class, 'hello'])
        ->name('hello');
    Route::get('/about', [HomeController::class, 'about'])
        ->name('about');
});


// categories routes
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('category.index');


// admin routes
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => '',
        'as' => 'admin.'
    ],
    function () {
        Route::get('/', AdminController::class)
            ->name('index');
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('news', AdminNewsController::class);
        Route::resource('feedsources', AdminFeedsourceController::class);
        Route::resource('orders', AdminOrderController::class);
        Route::resource('feedback', AdminFeedbackController::class);
});


//news routes
Route::group(['prefix' => 'news', 'namespace' => '', 'as' => 'news.'], function () {
    Route::get('/category/{id}', [NewsController::class, 'index'])
        ->where('id', '\d+')
        ->name('index');
    Route::get('/{id}', [NewsController::class, 'show'])
        ->where('id', '\d+')
        ->name('show');
});


// feedback routes
Route::get('/feedback/index', [FeedbackController::class, 'index'])
    ->name('feedback.index');
Route::get('/feedback/create', [FeedbackController::class, 'create'])
    ->name('feedback.create');
Route::post('/feedback/store', [FeedbackController::class, 'store'])
    ->name('feedback.store');
