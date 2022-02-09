<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(Post $post): RedirectResponse
    {
        request()->validate([
            'body' => ['required']
        ]);

        $post->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->user()->id,
        ]);

        return back();
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
