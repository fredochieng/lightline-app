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

/** Include auth, admin middlewares */

use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'account.verified', 'role:Admin'])->group(
    function () {
        Route::prefix('admin')->group(function () {

            /** Panel Management Module */
            Route::namespace('\Modules\Panel\Http\Controllers')->group(function () {
                Route::get('/panel', 'PanelController@panelActiveBlade')->name('admin.panel.active');
                Route::get('/panel/fetch', 'PanelController@panelActiveFetch')->name('admin.panel.active.fetch');
                Route::get('/panel/&id={id}', 'PanelController@getPanelDetails')->name('admin.get.panel.details');
            });

            /** Points Management Module */
            Route::namespace('\Modules\Redemptions\Http\Controllers')->group(function () {
                Route::get('/points/transactions', 'RedemptionsController@showTransView')->name('admin.show.trans.view');
                Route::get('/points/transactions/fetch', 'RedemptionsController@pointsTransactionsFetch')->name('admin.points.trans.fetch');
            });

            /** Redemptions Management Module */
            Route::namespace('\Modules\Redemptions\Http\Controllers')->group(function () {
                Route::get('/panel/redemptions', 'RedemptionsController@showRedemptionsView')->name('admin.show.red.view');
                Route::get('/panel/redemptions/fetch', 'RedemptionsController@panelRedemptionsFetch')->name('admin.points.trans.fetch');
                Route::get('/panel/award-points', 'RedemptionsController@uploadPointsFile')->name('admin.show.award.points');
                Route::post('/panel/award-points/upload', 'RedemptionsController@saveUploadPointsFile')->name('points.upload.file');
                Route::get('/bulk/upload/preview/{id}', 'RedemptionsController@uploadFilePreview')->name('admin.points.bulk.preview');
                Route::post('/bulk/upload/process', 'RedemptionsController@processUploadPointsFile')->name('admin.process.bulk.upload');
            });

            Route::namespace('\Modules\Admin\Http\Controllers')->group(function () {
                Route::get('/dashboard', 'AdminDashboardController@dashboardView')->name('admin.dashboard');
            });

            Route::namespace('\Modules\Admin\Http\Controllers')->group(function () {
                Route::get('/profile', 'AdminController@adminProfileView')->name('admin.show.profile.view');
            });
        });
    }
);
