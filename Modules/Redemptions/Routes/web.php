<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Redemptions\Http\Controllers\RedemptionsController;

Route::middleware(['auth', 'account.verified'])->group(function () {
    Route::get('/user/redemptions', [RedemptionsController::class, 'index'])->name('user.redemptions');
    Route::get('/user/get-redemptions', [RedemptionsController::class, 'getUserRedemptions'])->name('user.getRedemptions');
    Route::post('/user/redeem-points', [RedemptionsController::class, 'store'])->name('user.redeem');

    Route::get('/user/transactions', [RedemptionsController::class, 'transactionsList'])->name('user.transactionList');
    Route::get('/user/get-transactions', [RedemptionsController::class, 'getUserPointTransactions'])->name('user.get-transactions');
});
