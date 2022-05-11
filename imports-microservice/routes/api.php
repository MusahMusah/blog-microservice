<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('/imports', [AdminController::class, 'getImportsToExecute'])
        ->name('getImportsToExecute');

/**
 * ADMIN ROUTES
 */
Route::group(['middleware' => ['auth.admin']], fn () => [
    Route::post('admin/create-import', [AdminController::class, 'createImport'])
        ->name('create-import'),
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'),
]);
