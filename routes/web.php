<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WelcomeController;

// Route for the welcome page, handled by WelcomeController's 'welcome' method
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Route to display a single post based on its 'id', handled by PostController's 'show' method
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route to display the list of all posts, handled by PostController's 'index' method
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Route for creating a comment on a specific post, handled by CommentController's 'store' method
// This route accepts a POST request to add a comment to the given post
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// Route for deleting a specific comment, handled by CommentController's 'destroy' method
// This route accepts a DELETE request to remove the comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
