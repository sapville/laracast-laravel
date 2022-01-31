<?php

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

Route::get('/', function () {

//    \Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql, $query->bindings));

    return view('posts', [
        'blogPosts' => Post::all()
    ]);
});

Route::get('posts/{post:slug}', function (Post $post) {
    return view('post',
        ['blogPost' => $post]
    );
});

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts',
        ['blogPosts' => $category->posts]
    );
});

Route::get('authors/{author:username}', function (User $author) {
    return view('posts',
        ['blogPosts' => $author->posts]
    );
});
