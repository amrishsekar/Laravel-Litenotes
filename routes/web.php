<?php

use App\Models\note;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\noteController;
use Symfony\Component\Console\Input\Input;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;
use Illuminate\Routing\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// This line alone generates all the required resource routes:~
Route::resource('/notes', noteController::class)->middleware(['auth']);

Route::get('/trashed', [TrashedNoteController::class, 'index'])->middleware('auth')->name('trashed.index');
Route::get('/trashed/{note}', [TrashedNoteController::class, 'show'])->withTrashed()->middleware('auth')->name('trashed.show');
Route::put('/trashed/{note}', [TrashedNoteController::class, 'restore'])->withTrashed()->middleware('auth')->name('trashed.restore');
Route::delete('/trashed/{note}', [TrashedNoteController::class, 'destroy'])->withTrashed()->middleware('auth')->name('trashed.destroy');
// Route::get('/trashed/search', [TrashedNoteController::class, 'search'])->withTrashed()->middleware('auth')->name('trashed.search');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
