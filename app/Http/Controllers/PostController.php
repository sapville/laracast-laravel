<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        //    \Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql, $query->bindings));

        return view('posts.index', [
            'blogPosts' => Post::query()->orderBy('updated_at', 'desc')->filter(request()->only(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
                'blogPost' => $post,
                'source' => Str::contains(request()->headers->get('referer'), 'dashboard') ? 'dashboard' : 'start'
            ]
        );
    }

}
