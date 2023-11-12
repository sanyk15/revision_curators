<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::get('/activities/get-for-month', [\App\Http\Controllers\ActivityController::class, 'getActivitiesForMonthByDate'])->name('activities.for-month');

Route::middleware('auth')->group(function () {
    Route::resource('curators', \App\Http\Controllers\CuratorController::class);
    Route::resource('groups', \App\Http\Controllers\GroupController::class);
    Route::resource('activity_kinds', \App\Http\Controllers\ActivityKindController::class);
    Route::resource('indicators', \App\Http\Controllers\IndicatorController::class);
    Route::resource('benchmarks', \App\Http\Controllers\BenchmarkController::class);
    Route::resource('additional_events', \App\Http\Controllers\AdditionalEventController::class);
    Route::resource('activities', \App\Http\Controllers\ActivityController::class);

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('main', [\App\Http\Controllers\ReportController::class, 'reportsView'])->name('main');
        Route::post('download_report', [\App\Http\Controllers\ReportController::class, 'downloadReport'])->name('report.download');
    });
});
