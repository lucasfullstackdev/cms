<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('logout/all', [AuthController::class, 'logoutAll']);
    });
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Admin Routes
    Route::prefix('admin')->middleware(AdminAccess::class)->group(function () {
        Route::prefix('/tags')->group(realpath(__DIR__ . '/api/v1/admin/tags.php'));
        Route::prefix('/post/statuses')->group(realpath(__DIR__ . '/api/v1/admin/post_statuses.php'));
    });

    Route::prefix('/posts')->group(realpath(__DIR__ . '/api/v1/common/posts.php'));
});
