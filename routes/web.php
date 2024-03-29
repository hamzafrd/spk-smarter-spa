<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SmarterHasilController;
use App\Http\Controllers\SubKriteriaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::resource('/dashboard', DashboardController::class)->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('kriteria', KriteriaController::class);
    Route::resource('subkriteria', SubKriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);
    Route::resource('hasil-smarter', SmarterHasilController::class);
});

require __DIR__ . '/auth.php';
