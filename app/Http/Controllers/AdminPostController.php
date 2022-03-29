<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    private array $validation_rules;

    public function __construct()
    {
        $this->validation_rules = [
            'title' => ['required', 'max:255', Rule::unique('posts', 'title'),
                function($attribute, $value, $fail) {
                    $post = new Post();
                    $post->title = $value;
                    if (Post::query()->where('slug', '=', $post->slug)->first())
                        $fail('Please choose another title');
                }],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'thumbnail' => ['required', 'image']
        ];
    }

    public function index()
    {
        return view('posts.admin.index', ['posts' => Post::query()->orderByDesc('updated_at')->paginate(10)]);
    }

    public function create()
    {
        return view('posts.admin.create');
    }

    public function edit(Post $post, Request $request)
    {
        request()->session()->put('source', url()->previous());
        return view('posts.admin.edit', [
            'post' => $post,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function store(Post $post, Request $request)
    {

        $this->authorize('admin');
        $attributes = request()->validate($this->validation_rules);

        $attributes['user_id'] = auth()->user()->id;
        $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        $attributes['published_at'] = $request->input('draft') ? null : Carbon::now();

        $post = Post::query()->create($attributes);

        return redirect('posts/' . $post->slug)->with('success','Post has been published');
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Post $post, Request $request)
    {
        $this->authorize('admin');
        $this->validation_rules['title'] = ['required', 'max:255', Rule::unique('posts', 'title')->ignore($post)];
        if (!$request->has('thumbnail')) {
            unset($this->validation_rules['thumbnail']);
        }

        $attributes = request()->validate($this->validation_rules);

        if (isset($this->validation_rules['thumbnail']))
            $attributes['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        $attributes['published_at'] = $request->input('draft') ? null : now();

        $post->update($attributes);

        return redirect(
            $request->session()->has('source') ? $request->session()->pull('source') : '/'
        )->with('success', 'Post has been updated');

    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('admin');
        $post->delete();
        return back()->with('success', 'Post has been deleted');
    }
}

