<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdererController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Vertical navigation routes
    Route::get('/dashboard/overview', function () {
        return view('dashboard.overview');
    })->name('dashboard.overview');

    Route::get('/orderers/create', [OrdererController::class, 'create'])->name('orderers.create');
    Route::post('/orderers', [OrdererController::class, 'store'])->name('orderers.store'); // Add this line

    Route::get('/dashboard/settings', function () {
        return view('dashboard.settings');
    })->name('dashboard.settings');

    Route::get('/dashboard/profile', function () {
        return view('dashboard.profile');
    })->name('dashboard.profile');

    Route::get('/dashboard/support', function () {
        return view('dashboard.support');
    })->name('dashboard.support');
});
