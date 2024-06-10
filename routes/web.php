<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('activities.index');
});

Route::get('/activities/get-for-month', [\App\Http\Controllers\ActivityController::class, 'getActivitiesForMonthByDate'])->name('activities.for-month');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::resource('activity_kinds', \App\Http\Controllers\ActivityKindController::class)->except(['index', 'show']);
        Route::resource('indicators', \App\Http\Controllers\IndicatorController::class)->except(['index', 'show']);
        Route::resource('benchmarks', \App\Http\Controllers\BenchmarkController::class)->except(['index', 'show']);
        Route::resource('users', \App\Http\Controllers\UserController::class);
        Route::resource('activities', \App\Http\Controllers\ActivityController::class)->except(['index', 'show']);
        Route::resource('activity_types', \App\Http\Controllers\ActivityTypeController::class)->except(['index', 'show']);
        Route::get('groups/trans-to-next-course', [\App\Http\Controllers\GroupController::class, 'transToNextCourseForm'])->name('groups.trans-to-next-course.form');
        Route::post('groups/trans-to-next-course', [\App\Http\Controllers\GroupController::class, 'transToNextCourse'])->name('groups.trans-to-next-course');
        Route::get('groups/import', [\App\Http\Controllers\GroupController::class, 'importForm'])->name('groups.import.form');
        Route::post('groups/import', [\App\Http\Controllers\GroupController::class, 'import'])->name('groups.import');
    });

    Route::middleware('role:curator|admin')->group(function () {
        Route::resource('groups', \App\Http\Controllers\GroupController::class)->except(['index', 'show']);
        Route::resource('activities', \App\Http\Controllers\ActivityController::class)->except(['index', 'show']);
        Route::get('activities/{activity}/add-groups', [\App\Http\Controllers\ActivityController::class, 'addGroupsForm'])->name('activities.add-groups-form');
        Route::post('activities/{activity}/add-groups', [\App\Http\Controllers\ActivityController::class, 'addGroups'])->name('activities.add-groups');
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('main', [\App\Http\Controllers\ReportController::class, 'reportsView'])->name('main');
            Route::post('download_report', [\App\Http\Controllers\ReportController::class, 'downloadReport'])->name('report.download');
        });

        Route::prefix('groups/{group}/')->group(function () {
            Route::resource('students', \App\Http\Controllers\StudentController::class);
        });
    });

    Route::resource('groups', \App\Http\Controllers\GroupController::class)->only(['index', 'show']);
    Route::resource('activity_kinds', \App\Http\Controllers\ActivityKindController::class)->only(['index', 'show']);
    Route::resource('indicators', \App\Http\Controllers\IndicatorController::class)->only(['index', 'show']);
    Route::resource('benchmarks', \App\Http\Controllers\BenchmarkController::class)->only(['index', 'show']);
    Route::resource('activities', \App\Http\Controllers\ActivityController::class)->only(['index', 'show']);
    Route::resource('activity_types', \App\Http\Controllers\ActivityTypeController::class)->only(['index', 'show']);

    Route::get('profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('profile');
    Route::post('profile', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('update-profile');
});
