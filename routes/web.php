<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrdererController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrawingPartController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Single route to load the dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orderer-related actions
   Route::resource('orderers', OrdererController::class);
//    Route::resource('projects', ProjectController::class);
    Route::delete('/orderers/{orderer}', [OrdererController::class, 'destroy'])->name('orderers.destroy');


    // Project-related actions under a specific orderer
    Route::post('/orderers/{orderer}/projects', [ProjectController::class, 'store'])->name('orderers.projects.store');
    Route::get('/orderers/{orderer}/projects', [ProjectController::class, 'create'])->name('orderers.projects.create');


    // Additional dashboard pages rendered in the main area
    Route::view('/dashboard/settings', 'dashboard.settings')->name('dashboard.settings');
    Route::view('/dashboard/profile', 'dashboard.profile')->name('dashboard.profile');
    Route::view('/dashboard/support', 'dashboard.support')->name('dashboard.support');

    Route::prefix('projects/{project}')->group(function () {
        Route::get('drawing-parts', [DrawingPartController::class, 'index'])->name('projects.drawing-parts.index');
        Route::get('drawing-parts/create', [DrawingPartController::class, 'create'])->name('projects.drawing-parts.create');
        Route::post('drawing-parts', [DrawingPartController::class, 'store'])->name('projects.drawing-parts.store');
        Route::get('drawing-parts/{drawingPart}', [DrawingPartController::class, 'show'])->name('projects.drawing-parts.show');
    });
});
