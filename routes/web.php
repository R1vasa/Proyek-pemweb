<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\UserAkses;
use App\Http\Middleware\CheckProfileComplete;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login']);
    Route::get('/register', [SessionController::class, 'register']);
    Route::post('/register/create', [SessionController::class, 'create']);
});

/*
|--------------------------------------------------------------------------
| Authenticated & Profile-Completed Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', CheckProfileComplete::class])->group(function () {
    // User Dashboard
    Route::get('/home', [UsersController::class, 'index'])->middleware(UserAkses::class . ':user');

    // Admin Dashboard
    Route::get('/admin', [UsersController::class, 'index'])->middleware(UserAkses::class . ':admin');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(UserAkses::class . ':admin');

    // Logout
    Route::get('/logout', [SessionController::class, 'logout']);

    // Posts
    Route::resource('posts', PostsController::class)->except(['create', 'edit', 'show']);
    Route::post('/posts/{id}/like', [PostsController::class, 'like'])->name('posts.like');
    Route::get('/home/post/{id}', [PostsController::class, 'showWithComments'])->name('post.comments');

    //Comments
    Route::post('/posts/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


    // Profile
    Route::get('/profile', [PostsController::class, 'myPosts'])->name('profile');
    Route::get('/my-posts', [PostsController::class, 'myPosts']);
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete');

    // Admin Actions on Users
    Route::post('/users/{id}/ban', [UsersController::class, 'ban'])->name('users.ban');
    Route::post('/user/unban/{id}', [UsersController::class, 'unban'])->name('users.unban');
    Route::post('/user/make-admin/{id}', [UsersController::class, 'makeAdmin'])->name('users.makeAdmin');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

/*
|--------------------------------------------------------------------------
| Profile Completion Routes (Auth, but not complete)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/register/profile', [SessionController::class, 'showProfileForm']);
    Route::post('/register/profile/store', [SessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Auth::check() ? redirect('/home') : redirect('/login');
});
