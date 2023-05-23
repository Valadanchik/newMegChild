<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale()
    ], function () {

    /* Home Roure */
    Route::get('/', [\App\Http\Controllers\frontend\HomeController::class, 'index'])->name('index');

    /* Books routers */
    Route::get('books', 'App\Http\Controllers\frontend\BooksController@books')->name('books');
    Route::get('book/{slug}', 'App\Http\Controllers\frontend\BooksController@view')->name('view');

    /* Posts routers */
    Route::get('articles', 'App\Http\Controllers\frontend\PostsController@articles')->name('articles');
    Route::get('article/{id}', 'App\Http\Controllers\frontend\PostsController@view')->name('view');


























});
