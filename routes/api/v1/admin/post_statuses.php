<?php

use App\Domains\Admin\Posts\Status\PostStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostStatusController::class, 'index']);
Route::post('/', [PostStatusController::class, 'store']);
Route::get('/{id}', [PostStatusController::class, 'show']);
Route::put('/{id}', [PostStatusController::class, 'update']);
Route::delete('/{id}', [PostStatusController::class, 'destroy']);
