<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/announcement', function(){
    return Inertia::render('Announcement');
})->middleware(['auth', 'verified'])->name('announcement');

Route::get('/academic-schedule', function(){
    return Inertia::render('Academic-Schedule');
})->middleware(['auth', 'verified'])->name('academic-schedule');


Route::get('/extra-study-materials', function(){
    return Inertia::render('Extra-Study-Materials');
})->middleware(['auth', 'verified'])->name('extra-study-material');


Route::get('/results', function(){
    return Inertia::render('Results');
})->middleware(['auth', 'verified'])->name('results');

Route::get('/extra-study-materials', function(){
    return Inertia::render('Extra-Study-Materials');
})->middleware(['auth', 'verified'])->name('extra-study-material');

Route::get('/admin-dashboard', function(){
    return Inertia::render('Admin-Dashboard');
})->middleware(['auth', 'verified'])->name('admin-dashboard');

Route::post('/create-announcement', [DashboardController::class, 'createAnnouncement'])->middleware(['auth', 'verified'])->name('create-announcement');
Route::get('/success-create', [DashboardController::class, 'successPage'])->middleware(['auth', 'verified'])->name('success-create');

Route::get('/admin', function(){
    return Inertia::render('Auth/AdminLogin');
})->middleware(['auth', 'verified'])->name('Admin');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
