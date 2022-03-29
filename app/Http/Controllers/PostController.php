<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostView;
use Illuminate\Support\Facades\Auth;
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

        if (Auth::id() && $post->author->id !== Auth::id())
            PostView::query()->create([
                'post_id' => $post->id,
                'user_id' => Auth::id()
            ]);

        return view('posts.show', [
                'blogPost' => $post,
                'source' => Str::contains(request()->headers->get('referer'), 'dashboard') ? 'dashboard' : 'start'
            ]
        );
    }

}
