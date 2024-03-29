<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\PodcastCategoryController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SearchController;
use App\Models\Episode;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Middleware\VerifyISAE;
use App\Http\Middleware\VerifyProfile;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// routes/web.php





Route::get('/podcast/{id}', [PodcastController::class, 'show'])->name('podcast.show');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/explore', [ExploreController::class, 'show'])->name('explore');

Route::get('/history', function () {
    return view('history');
})->name('history');

// Route::get('/profile', [ProfileController::class, 'getSubsByUser'])->name('profile.index');

Route::get('/profile/{id}',  [ProfileController::class, 'profile_view'])->middleware('verifyProfile')->name('profile.viewer');

Route::get('/myprofile',  [ProfileController::class, 'view'])->middleware(['auth'])->name('profile');

Route::get('/search' , [SearchController::class, 'view'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/settings', [SettingsController::class, 'destroy'])->name('settings.destroy');
});

Route::middleware(['auth' , 'verified' ,'isAdmin'])->group(function() {
    Route::get('/admindashboard', [AdminController::class, 'show'])->name('admindashboard');
    Route::post('/admindashboard/category', [AdminController::class, 'store'])->name('category.store');
    Route::delete('/admindashboard/category/{category}', [AdminController::class, 'destroy_category'])->name('category.destroy');
    Route::delete('/admindashboard/user/{user}', [AdminController::class, 'destroy_user'])->name('user.destroy');

});

Route::middleware(['auth' , 'verified' ,'verifyIsae'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::post('/dashboard/episode', [EpisodeController::class, 'store'])->name('episode.store');
    Route::delete('/podcast/{episode}', [EpisodeController::class, 'destroy'])->name('episode.destroy');
    Route::post('/dashboard/podcast', [PodcastController::class, 'store'])->name('podcast.store');
    Route::delete('/podcast/{podcast}', [PodcastController::class, 'destroy'])->name('podcast.destroy');

});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/explore');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


require __DIR__.'/auth.php';
