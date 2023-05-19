<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
})->middleware(['auth', 'verified' ,'verifyisae'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/explore', function () {
    return view('explore');
})->name('explore');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/liked', function () {
    return view('liked');
})->name('liked');

Route::get('/create-podcast', function () {
    return view('podcast.create-form');
})->name('podcast-create-form');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
