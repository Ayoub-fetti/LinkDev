<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Connections;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [ConnectionController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/view', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/notifications', [ProfileController::class, 'notification'])->name('my.notification');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/Profile', [ProfileController::class, 'addSkills'])->name('profile.addSkills');

    Route::post('/connections/send', [ConnectionController::class, 'sendRequest'])->name('connections.send');
    Route::post('/connections/accept', [ConnectionController::class, 'acceptRequest'])->name('connections.accept');
    Route::post('/connections/reject', [ConnectionController::class, 'rejectRequest'])->name('connections.reject');

  
    Route::get('profile/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('profile/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::delete('profile/{projects}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    
    
    Route::resource('profile/certifications', CertificationController::class);
    Route::resource('posts/posts', PostController::class);
    
});


require __DIR__.'/auth.php';
