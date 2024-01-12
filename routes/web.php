<?php

use App\RMVC\Route\Route;

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index')->middleware('auth');

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show')->middleware('auth');