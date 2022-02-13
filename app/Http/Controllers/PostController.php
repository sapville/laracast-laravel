<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        //    \Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql, $query->bindings));

        return view('posts.index', [
            'blogPosts' => Post::query()->orderBy('id', 'desc')->filter(request()->only(['search', 'category', 'author']))->paginate(6)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show',
            ['blogPost' => $post]
        );
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Post $post)
    {
        $this->authorize('create', $post);
        $attributes = request()->validate([
            'title' => ['required', 'max:255', Rule::unique('posts', 'title')],
            'excerpt' => 'required',
            'body' => 'required',
        ]);

        $attributes['slug'] = Str::of($attributes['title'])->slug();
        $attributes['user_id'] = auth()->user()->id;
        $attributes['category_id'] = Category::query()->first()->id;

        $post = Post::query()->create($attributes);

        return redirect('posts/' . $post->slug)->with('Post has been published');
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect('/')->with('success', 'Post has been deleted');
    }
}
