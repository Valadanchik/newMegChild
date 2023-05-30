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

Route::post('/payment/telcellCallback', [\App\Http\Controllers\frontend\PaymentController::class, 'telcellCallback'])->name('payment.telcell_callback');
Route::post('/payment/idramCallback', [\App\Http\Controllers\frontend\PaymentController::class, 'idramCallback'])->name('payment.idram_callback');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
