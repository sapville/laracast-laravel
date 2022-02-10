<?php

namespace App\Http\Controllers;

use App\Services\Newsletter;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        $attributes = request()->validate([
            'email' => ['required', 'email']
        ]);

        try {

            $newsletter->subscribe($attributes['email']);

        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents());
            throw ValidationException::withMessages(['email' => $error->title]);
        } catch (Exception $e) {
            throw ValidationException::withMessages(['email' => 'Error when subscribing']);
        }

        return back()->with('success', 'You\'ve signed up for the news');

    }
}
