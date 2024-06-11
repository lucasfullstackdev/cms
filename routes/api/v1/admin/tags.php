<?php

use App\Domains\Admin\Tags\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TagController::class, 'index']);
Route::post('/', [TagController::class, 'store']);
Route::get('/{id}', [TagController::class, 'show']);
Route::put('/{id}', [TagController::class, 'update']);
Route::delete('/{id}', [TagController::class, 'destroy']);