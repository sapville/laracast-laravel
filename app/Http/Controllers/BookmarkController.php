<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $user = Auth::user() ?? new User();
        return view('posts.index', [
            'blogPosts' => $user->bookmarks()->paginate(6)
        ]);
    }

    public function update(Post $post)
    {

        if (!Auth::id()) {
            return redirect('/');
        }

        if ($post->bookmarks()->get()->firstWhere('id', Auth::id()))
            Bookmark::query()->firstWhere(['post_id' => $post->id, 'user_id' => Auth::id()])->delete();
        else
            Bookmark::query()->create(['post_id' => $post->id, 'user_id' => Auth::id()]);

        return back()->with('success', 'Post has been bookmarked');
    }
}
