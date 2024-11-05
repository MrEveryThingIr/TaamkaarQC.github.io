<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GitCommitController;
use App\Http\Controllers\HtmlElementController;
use App\Http\Controllers\ElementClassController;
use App\Http\Controllers\ActualElementController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource routes for managing HTML elements and classes
    Route::resource('html-elements', HtmlElementController::class)->except(['show']);
    Route::resource('element-classes', ElementClassController::class)->except(['show']);

    // Routes for creating and managing ActualElements
    Route::get('actual-elements/create', [ActualElementController::class, 'create'])->name('actual-elements.create');
    Route::post('actual-elements/store', [ActualElementController::class, 'store'])->name('actual-elements.store');


    Route::resource('git-commits', GitCommitController::class);
});
