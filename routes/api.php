<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/telcellCallback', [\App\Http\Controllers\frontend\PaymentController::class, 'telcellCallback'])->name('payment.telcell_callback');
Route::post('/payment/idramCallback', [\App\Http\Controllers\frontend\PaymentController::class, 'idramCallback'])->name('payment.idram_callback');


Route::get('/all-books', [\App\Http\Controllers\api\BooksController::class, 'getAllBooks'])->name('api.all.books');
Route::get('/last-books', [\App\Http\Controllers\api\BooksController::class, 'getLastBooks'])->name('api.last.books');
Route::get('/last-posts', [\App\Http\Controllers\api\PostsController::class, 'getLastPosts'])->name('api.last.posts');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
