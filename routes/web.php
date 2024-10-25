<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrdererController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DrawingController;

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
    Route::post('/orderers', [OrdererController::class, 'store'])->name('orderers.store');

    // Project-related actions under a specific orderer
    Route::post('/orderers/{orderer}/projects', [ProjectController::class, 'store'])->name('orderers.projects.store');

    // Drawing-related actions for a specific project
    Route::post('/projects/{project}/drawings', [DrawingController::class, 'store'])->name('drawings.store');

    // Additional dashboard pages rendered in the main area
    Route::view('/dashboard/settings', 'dashboard.settings')->name('dashboard.settings');
    Route::view('/dashboard/profile', 'dashboard.profile')->name('dashboard.profile');
    Route::view('/dashboard/support', 'dashboard.support')->name('dashboard.support');
});
