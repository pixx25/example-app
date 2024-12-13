<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');