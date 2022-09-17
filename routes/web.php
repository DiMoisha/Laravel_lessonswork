<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SocialProvidersController;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FeedsourceController as AdminFeedsourceController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\UserController as AdminUserController;



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



Route::middleware('auth')->group(function() {
    Route::resource('account', AccountController::class);

    Route::group(
        [
            'prefix' => 'admin',
            'as' => 'admin.',
            'middleware' => 'is_admin'
        ],
        function() {
            Route::get('/', AdminController::class)
                ->name('index');
            Route::get('/parser', ParserController::class)->name('parser');
            Route::resource('categories', AdminCategoryController::class);
            Route::resource('news', AdminNewsController::class);
            Route::resource('feedsources', AdminFeedsourceController::class);
            Route::resource('orders', AdminOrderController::class);
            Route::resource('feedback', AdminFeedbackController::class);
            Route::resource('users', AdminUserController::class);
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
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


Route::get('/collections', function() {
    $names = ['Anna', 'Jhon', 'Kim', 'Mike', 'Drake', 'Lili'];
    $collection = collect($names);

    dd($collection->map(
        fn($item) =>  strtoupper($item)
    )->sort()->toJson());
});

Route::get('/sessions', function() {
    $name = 'example';
    if(session()->has($name)) {

        session()->remove($name);
    }
    //session()->get($name);
    dd(session()->all());
    session()->put($name, 'Test example session');
});


Auth::routes();

//Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'guest'], function() {
    Route::get('/auth/redirect/{driver}', [SocialProvidersController::class, 'redirect'])
        ->where('driver', '\w+')
        ->name('social.auth.redirect');

    Route::get('/auth/callback/{driver}', [SocialProvidersController::class, 'callback'])
        ->where('driver', '\w+');
});


