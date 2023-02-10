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
Route::prefix('admin')->group(function () {

    //Route::get('/home', 'HomeController@index')->name('dashboard');
    //Route::get('/panel/active/fetch', [PanelController::class, 'panelActiveFetch'])->name('admin.panel.active.fetch');
    // Route::module('Panel', function () {
    //     Route::get('/panel/active', 'PanelController@panelActiveBlade')->name('admin.panel.active');
    // });
    //Route::get('/panel/active', 'PanelController@panelActiveBlade')->name('admin.panel.active');

    Route::namespace('\Modules\Panel\Http\Controllers')->group(function () {
        Route::get('/panel/active', 'PanelController@panelActiveBlade')->name('admin.panel.active');
        Route::get('/panel/active/fetch', 'PanelController@panelActiveFetch')->name('admin.panel.active.fetch');
        Route::get('/panel/&id={id}', 'PanelController@getPanelDetails')->name('admin.get.panel.details');;
    });
});
