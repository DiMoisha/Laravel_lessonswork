<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;

use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

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
//Route::get('/', [HomeController::class, 'index'])
//->name('home.index');
//Route::get('/', HomeController::class);
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
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', AdminController::class)
        ->name('index');
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('news', AdminNewsController::class);
});


//news routes
Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
    Route::get('/category/{id}', [NewsController::class, 'index'])
        ->where('id', '\d+')
        ->name('index');
    Route::get('/{id}', [NewsController::class, 'show'])
        ->where('id', '\d+')
        ->name('show');
});


