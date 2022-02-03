<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        //    \Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql, $query->bindings));
        return view('posts.index', [
            'blogPosts' => Post::query()->latest()->filter(request()->only(['search', 'category', 'author']))->get(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show',
            ['blogPost' => $post]
        );
    }
}
