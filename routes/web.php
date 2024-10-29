<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdererController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrawingPartController;
use App\Http\Controllers\DimensionController; // Add DimensionController

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource route for Orderers (includes index, show, store, update, destroy)
    Route::resource('orderers', OrdererController::class)->except(['create', 'edit']);

    // Project-related routes nested under specific Orderer
    Route::prefix('orderers/{orderer}')->name('orderers.')->group(function () {
        Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    });

    // Drawing Part routes nested under specific Project
    Route::prefix('projects/{project}/drawing-parts')->name('projects.drawing-parts.')->group(function () {
        Route::get('/', [DrawingPartController::class, 'index'])->name('index');
        Route::get('/create', [DrawingPartController::class, 'create'])->name('create');
        Route::post('/', [DrawingPartController::class, 'store'])->name('store');
        Route::get('/{drawingPart}', [DrawingPartController::class, 'show'])->name('show');

        // Dimension routes nested under each DrawingPart
        Route::prefix('{drawingPart}/dimensions')->name('dimensions.')->group(function () {
            Route::post('/', [DimensionController::class, 'store'])->name('store'); // Store new dimension
            Route::get('/{dimension}/edit', [DimensionController::class, 'edit'])->name('edit'); // Edit dimension
            Route::put('/{dimension}', [DimensionController::class, 'update'])->name('update'); // Update dimension
            Route::delete('/{dimension}', [DimensionController::class, 'destroy'])->name('destroy'); // Delete dimension
        });
    });
});
