<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {

        //    \Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql, $query->bindings));

        return view('posts', [
            'blogPosts' => Post::query()->latest()->filter(request()->only(['search', 'category']))->get(),
        ]);
    }

    public function show(Post $post)
    {
        return view('post',
            ['blogPost' => $post]
        );
    }
}
