<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::get('/activities/get-for-month', [\App\Http\Controllers\ActivityController::class, 'getActivitiesForMonthByDate'])->name('activities.for-month');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::resource('groups', \App\Http\Controllers\GroupController::class)->except(['index', 'show']);
        Route::resource('activity_kinds', \App\Http\Controllers\ActivityKindController::class)->except(['index', 'show']);
        Route::resource('indicators', \App\Http\Controllers\IndicatorController::class)->except(['index', 'show']);
        Route::resource('benchmarks', \App\Http\Controllers\BenchmarkController::class)->except(['index', 'show']);
        Route::resource('additional_events', \App\Http\Controllers\AdditionalEventController::class)->except(['index', 'show']);
    });

    Route::middleware('role:curator|admin')->group(function () {
        Route::resource('activities', \App\Http\Controllers\ActivityController::class)->except(['index', 'show']);
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('main', [\App\Http\Controllers\ReportController::class, 'reportsView'])->name('main');
            Route::post('download_report', [\App\Http\Controllers\ReportController::class, 'downloadReport'])->name('report.download');
        });
    });

    Route::resource('curators', \App\Http\Controllers\CuratorController::class);
    Route::resource('groups', \App\Http\Controllers\GroupController::class)->only(['index', 'show']);
    Route::resource('activity_kinds', \App\Http\Controllers\ActivityKindController::class)->only(['index', 'show']);
    Route::resource('indicators', \App\Http\Controllers\IndicatorController::class)->only(['index', 'show']);
    Route::resource('benchmarks', \App\Http\Controllers\BenchmarkController::class)->only(['index', 'show']);
    Route::resource('additional_events', \App\Http\Controllers\AdditionalEventController::class)->only(['index', 'show']);
    Route::resource('activities', \App\Http\Controllers\ActivityController::class)->only(['index', 'show']);
});
