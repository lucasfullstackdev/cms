<?php

use App\Domains\Common\Posts\PostController;
use App\Http\Middleware\CouldCreatePost;
use App\Http\Middleware\CouldDeletePost;
use App\Http\Middleware\CouldEditPost;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);
Route::get('/{id}', [PostController::class, 'show']);

Route::post('/', [PostController::class, 'store'])->middleware(CouldCreatePost::class);
Route::delete('/{id}', [PostController::class, 'destroy'])->middleware(CouldDeletePost::class);

Route::middleware(CouldEditPost::class)->group(function () {
  Route::put('/{id}', [PostController::class, 'update']);
  Route::patch('/{id}/tags', [PostController::class, 'updateTags']);
  Route::patch('/{id}/status', [PostController::class, 'updateStatus']);
});
