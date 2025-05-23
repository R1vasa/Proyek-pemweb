<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\UserAkses;
use App\Http\Middleware\CheckProfileComplete;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostsController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login']);
    Route::get('/register', [SessionController::class, 'register']);
    Route::post('/register/create', [SessionController::class, 'create']);
});

Route::middleware(['auth', CheckProfileComplete::class])->group(function () {
    Route::get('/home', [UsersController::class, 'index'])->middleware(UserAkses::class . ':user');
    Route::get('/admin', [UsersController::class, 'index'])->middleware(UserAkses::class . ':admin');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(UserAkses::class . ':admin');
    Route::get('/logout', [SessionController::class, 'logout']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/register/profile', [SessionController::class, 'showProfileForm']);
    Route::post('/register/profile/store', [SessionController::class, 'store']);
    Route::post('/posts/{id}/like', [PostsController::class, 'like'])->name('posts.like');
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
    Route::put('/posts/{id}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
});


Route::post('/users/{id}/ban', [UsersController::class, 'ban'])->name('users.ban');
Route::post('/user/unban/{id}', [UsersController::class, 'unban'])->name('users.unban');
Route::post('/user/make-admin/{id}', [UsersController::class, 'makeAdmin'])->name('users.makeAdmin');
Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');

Route::get('admin/dashboard', [AdminController::class, 'index'])->name('dashboard');


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return redirect('/login');
});
