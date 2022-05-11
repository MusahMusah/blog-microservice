<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

/**
 * USER MANAGEMENT ROUTES
 */
Route::group(['middleware' => ['auth:sanctum'], 'as' => 'user.'], fn () => [
    Route::get('/user', fn () => response()->success(auth()->user(), 'User Information retrieved successfully.'))
            ->name('info'),
    Route::get('/user/authenticate', [AuthController::class, 'authenticate'])
            ->name('authenticate'),
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'),
]);

/**
 * ADMINISTRATOR MANAGEMENT ROUTES
 */
Route::group(['middleware' => [], 'as' => 'admin.'], fn () => [
    Route::get('/getUsers', [UserController::class, 'getUsers'])
            ->name('getUsers'),
    Route::get('/getUserAdmin', [UserController::class, 'getUserAdmin'])
            ->name('getUserAdmin'),

]);

