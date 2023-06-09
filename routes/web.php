<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\PodcastCategoryController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Models\Episode;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;


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


Route::get('/podcast/{id}', [PodcastController::class, 'show'])->name('podcast.show');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/explore', [ExploreController::class, 'show'])->name('explore');

Route::get('/history', function () {
    return view('history');
})->name('history');

Route::get('/profile',  [ProfileController::class, 'view'])->middleware(['auth'])->name('profile');

Route::get('/create-podcast', function () {
    return view('podcast.create-form');
})->name('podcast-create-form');

Route::post('/submit-create-form', [PodcastController::class, 'store']);


Route::get('/category/{name}',[PodcastCategoryController::class, 'show' ]);

Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [SettingsController::class, 'destroy'])->name('settings.destroy');
});

Route::middleware(['auth' , 'verified' ,'verifyisae'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::post('/dashboard/episode', [EpisodeController::class, 'store'])->name('episode.store');
    Route::post('/dashboard/podcast', [PodcastController::class, 'store'])->name('podcast.store');
});


require __DIR__.'/auth.php';
