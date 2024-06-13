<?php

use App\Domains\Common\Posts\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);
Route::post('/', [PostController::class, 'store']);
Route::get('/{id}', [PostController::class, 'show']);
Route::put('/{id}', [PostController::class, 'update']);
Route::delete('/{id}', [PostController::class, 'destroy']);

Route::patch('/{id}/tags', [PostController::class, 'updateTags']);
Route::patch('/{id}/status', [PostController::class, 'updateStatus']);