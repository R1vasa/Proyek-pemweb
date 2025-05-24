<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Middleware\UserAkses;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login']);
    Route::get('/register', [SessionController::class, 'register']);
    Route::post('/register/create', [SessionController::class, 'create']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UsersController::class, 'index'])->middleware(UserAkses::class . ':user');
    Route::get('/admin', [UsersController::class, 'index'])->middleware(UserAkses::class . ':admin');
    Route::get('/logout', [SessionController::class, 'logout']);
    Route::get('/register/profile', [SessionController::class, 'showProfileForm']);
    Route::post('/register/profile/store', [SessionController::class, 'store']);
});


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');
});

Route::resource('posts', PostsController::class)->middleware('auth');
Route::get('/profile', [PostsController::class, 'myPosts'])->name('profile');
Route::get('/my-posts', [PostsController::class, 'myPosts'])->middleware('auth');
