<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/admin/dashboard', [AdminPostController::class, 'index'])->middleware('admin')->name('dashboard');
Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin')->name('post.create');
Route::post('/admin/posts/create', [AdminPostController::class, 'store'])->middleware('admin');
Route::post('/admin/posts/{post:slug}/delete', [AdminPostController::class, 'destroy'])->middleware('admin');

Route::post('posts/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth');
Route::post('comment/{comment}/delete', [CommentController::class, 'destroy'])->middleware('auth');

Route::get('register', [RegistrationController::class, 'create'])->middleware('guest');
Route::post('register', [RegistrationController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', NewsletterController::class);
