<?php

use App\Http\Controllers\frontend\ShopController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\ContactUsController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\BooksController;
use App\Http\Controllers\admin\AuthorsController;
use App\Http\Controllers\admin\TranslatorsController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\PostsController;
use App\Http\Controllers\admin\MediaController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\frontend\BookCommentsController;

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
    Route::get('category/{slug}', 'App\Http\Controllers\frontend\BooksController@booksByCategory')->name('category.books');
    Route::get('books', 'App\Http\Controllers\frontend\BooksController@books')->name('books');
    Route::get('book/{slug}', 'App\Http\Controllers\frontend\BooksController@view')->name('book.view');
    Route::post('books/search', 'App\Http\Controllers\frontend\BooksController@searchBooks')->name('books.search');
    Route::post('book/comment', [BookCommentsController::class, 'store'])->name('book.comment');
    /* Posts Routers */
    Route::get('articles', 'App\Http\Controllers\frontend\PostsController@articles')->name('articles');
    Route::get('article/{slug}', 'App\Http\Controllers\frontend\PostsController@view')->name('article.view');
    Route::get('medias/{slug}', 'App\Http\Controllers\frontend\PostsController@medias')->name('medias');
    Route::get('media-articles', 'App\Http\Controllers\frontend\PostsController@mediaArticles')->name('media.articles');
    /* Posts Routers */
    Route::get('authors', 'App\Http\Controllers\frontend\AuthorsController@authors')->name('authors');
    Route::get('author/{slug}', 'App\Http\Controllers\frontend\AuthorsController@view')->name('author.view');
    /* Translators Routers */
    Route::get('translators', 'App\Http\Controllers\frontend\TranslatorsController@translators')->name('translators');
    Route::get('translator/{slug}', 'App\Http\Controllers\frontend\TranslatorsController@view')->name('translator.view');
    /* About Us Router*/
    Route::get('about', function () {
        return view('about-us/about');
    })->name('about');
    /* Contact Us Router*/
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact.index');
    /* Order Router */
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::post('/order', [OrderController::class, 'create'])->name('order.create');
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/order/fail', [OrderController::class, 'fail'])->name('order.fail');
    /* Cart Router */
    Route::post('/add-to-cart', [ShopController::class, 'addToCart'])->name('addToCart');
    Route::post('/remove-from-card', [ShopController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/cart/update', [ShopController::class, 'updateCart'])->name('updateCart');

    /*************************** ADMIN ROUTES **************************/
    Route::group([
        'name' => 'admin.',
        'prefix' => 'fs-admin',
    ], function () {

        Route::get('login', [AuthController::class, 'loginView'])->name('admin.loginView');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/', function () {
                return view('admin.dashboard.index');
            });

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');
            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

            Route::resource('books', BooksController::class)->middleware('can:isAdmin');
            Route::resource('authors', AuthorsController::class)->middleware('can:isAdmin');
            Route::resource('translators', TranslatorsController::class)->middleware('can:isAdmin');
            Route::resource('categories', CategoriesController::class)->middleware('can:isAdmin');
            Route::resource('orders', AdminOrderController::class)->middleware('can:isAdmin');
            Route::resource('users', UserController::class)->middleware('can:isAdmin');
            Route::resource('posts', PostsController::class);
            Route::resource('medias', MediaController::class);
        });
    });
});
