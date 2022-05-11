<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

/**
 * USER MANAGEMENT ROUTES
 */
Route::group(['middleware' => ['auth.user'], 'prefix' => 'user', 'as' => 'user.'], fn () => [
    Route::post('/create-post', [PostController::class, 'createPost'])
        ->name('create-post'),
    Route::get('/posts', [PostController::class, 'getUserPosts'])
        ->name('posts'),
]);

/**
 * OTHER COMMON ROUTES
 */
Route::group(['middleware' => ['auth.user']], fn () => [
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'),
    Route::get('/posts/all', [PostController::class, 'getPosts'])
        ->name('posts.all'),
]);
