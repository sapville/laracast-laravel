<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts');

Route::get('categories/{category:slug}', function (Category $category) {

    return view('posts', [
        'blogPosts' => $category->posts()->getQuery()->latest()->filter(request()->only('search'))->get(),
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('categories');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'blogPosts' => $author->posts()->getQuery()->latest()->filter(request()->only('search'))->get(),
        'categories' => Category::all()
    ]);
})->name('authors');
