<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\PaymentController;

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
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
Route::get('/payment/telcellRedirect', [PaymentController::class, 'telcellRedirect'])->name('payment.telcell_redirect');
Route::get('/payment/arcaCallback', [PaymentController::class, 'arcaCallback'])->name('payment.arca_callback');

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
    Route::get('/about', function () {
        return view('about-us/about');
    });

    /* Order Router */

//    Route::get('order', 'App\Http\Controllers\frontend\OrderController@index')->name('order');
//    Route::post('/order', 'App\Http\Controllers\frontend\OrderController@create')->name('order.create');

    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');


//    Route::get('/add-to-cart', 'App\Http\Controllers\frontend\ShopController@addToCart')->name('addToCart');
    Route::post('/add-to-cart', [App\Http\Controllers\frontend\ShopController::class, 'addToCart'])->name('addToCart');
    Route::post('/remove-from-card', [App\Http\Controllers\frontend\ShopController::class, 'removeFromCart'])->name('removeFromCart');


});
