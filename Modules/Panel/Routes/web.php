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
use Modules\Panel\Http\Controllers\PanelController;

Route::middleware(['auth', 'account.verified', 'role:Panel'])->group(function () {
    Route::get('/user/profile/details', [PanelController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile/update', [PanelController::class, 'update_profile'])->name('user.profile.update');
    Route::post('/user/changePassword', [PanelController::class, 'changePass'])->name('user.change.pass');
    Route::get('/user/invites', [PanelController::class, 'userInvites'])->name('user.invites');
    Route::get('/user/get-invites', [PanelController::class, 'getUserReferralsData'])->name('user.get-invites');
    Route::post('/user/send-invites', [PanelController::class, 'userSendInvites'])->name('user.send-invites');
});

Route::middleware(['auth', 'account.verified', 'role:Admin'])->group(function () {
    Route::post('/user/changePassword', [PanelController::class, 'changePass'])->name('user.change.pass');
});
