<?php

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
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {
    $file = __DIR__ . "/../resources/posts/$slug.html";
    if (!file_exists($file))
//        ddd("file $file doesn't exist");
//        dd("file $file doesn't exist");
//        abort('404');
        return redirect('/');
    $post = cache()->remember("posts/$slug", now()->addHour(3), fn () => file_get_contents($file));
    return view('post',
        ['post' => $post]);
})->where('post', '[A-z_\-]+');
