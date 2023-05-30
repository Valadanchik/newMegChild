<?php

use App\Http\Controllers\frontend\ShopController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\frontend\OrderController;

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

    /* Home Route */
    Route::get('/', '\App\Http\Controllers\frontend\HomeController@index')->name('index');

    /* Books Routers */
    Route::get('books', 'App\Http\Controllers\frontend\BooksController@books')->name('books');
    Route::get('book/{slug}', 'App\Http\Controllers\frontend\BooksController@view')->name('view');

    /* Posts Routers */
    Route::get('articles', 'App\Http\Controllers\frontend\PostsController@articles')->name('articles');
    Route::get('article/{slug}', 'App\Http\Controllers\frontend\PostsController@view')->name('view');
    Route::get('medias/{slug}', 'App\Http\Controllers\frontend\PostsController@medias')->name('medias');

    /* Posts Routers */
    Route::get('authors', 'App\Http\Controllers\frontend\AuthorsController@authors')->name('authors');
    Route::get('author/{slug}', 'App\Http\Controllers\frontend\AuthorsController@view')->name('view');

    /* Translators Routers */
    Route::get('translators', 'App\Http\Controllers\frontend\TranslatorsController@translators')->name('translators');
    Route::get('translator/{slug}', 'App\Http\Controllers\frontend\TranslatorsController@view')->name('view');

    /* About Us Router*/
    Route::get('about', function () {
        return view('about-us/about');
    })->name('about');

    /* Order Router */

//    Route::get('order', 'App\Http\Controllers\frontend\OrderController@index')->name('order');
//    Route::post('/order', 'App\Http\Controllers\frontend\OrderController@create')->name('order.create');

    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/fail', [OrderController::class, 'fail'])->name('order.fail');


//    Route::get('/add-to-cart', 'App\Http\Controllers\frontend\ShopController@addToCart')->name('addToCart');
    Route::post('/add-to-cart', [ShopController::class, 'addToCart'])->name('addToCart');
    Route::post('/remove-from-card', [ShopController::class, 'removeFromCart'])->name('removeFromCart');

    Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('updateCart');
    Route::post('/cart/totalCount', [ShopController::class, 'getCartTotalCount'])->name('getCartTotalCount');

});
