<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {

//    \Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql, $query->bindings));

    $posts = Post::latest();

    if ($request = request('search')) {
        $posts
            ->where('body', 'like', "%$request%")
            ->orWhere('title', 'like', "%$request%");
    }
    return view('posts', [
        'blogPosts' => $posts->get(),
        'categories' => Category::all()
    ]);
})->name('home');

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post',
        ['blogPost' => $post]
    );
})->name('posts');

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'blogPosts' => $category->posts,
        'currentCategory' => $category,
        'categories' => Category::all()
    ]);
})->name('categories');

Route::get('authors/{author:username}', function (User $author) {
    return view('posts', [
        'blogPosts' => $author->posts,
        'categories' => Category::all()
    ]);
})->name('authors');
