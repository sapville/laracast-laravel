<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('back/{route}', fn(string $route) => redirect()->route($route));

Route::get('/', [PostController::class, 'index'])->name('start');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('/admin/dashboard', [AdminPostController::class, 'index'])->middleware('admin')->name('dashboard');
Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin')->name('post.create');
Route::get('/admin/posts/{post:slug}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
Route::post('/admin/posts/create', [AdminPostController::class, 'store'])->middleware('admin');
Route::delete('/admin/posts/{post:slug}', [AdminPostController::class, 'destroy'])->middleware('admin');

Route::post('posts/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth');
Route::delete('comment/{comment}', [CommentController::class, 'destroy'])->middleware('auth');

Route::get('register', [RegistrationController::class, 'create'])->middleware('guest');
Route::post('register', [RegistrationController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');
Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', NewsletterController::class);
