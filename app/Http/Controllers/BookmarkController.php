<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index() {

        $user = Auth::user() ?? new User();
        return view( 'posts.index', [
            'blogPosts' => $user->bookmarks()->paginate(6)
        ] );
    }
}
