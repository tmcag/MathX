<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::post('/generate', [MainController::class, 'generateExercises'])->name('exercises-generate');
Route::get('/print', [MainController::class, 'printExercises'])->name('exercises-print');
Route::get('/export', [MainController::class, 'exportExercises'])->name('exercises-export');
