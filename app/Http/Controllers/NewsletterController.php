<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        $attributes = request()->validate([
            'email' => ['required', 'email']
        ]);

        $newsletter->subscribe($attributes['email']);

        return back()->with('success', 'You\'ve signed up for the news');

    }
}
