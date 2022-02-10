<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use MailchimpMarketing\ApiClient;

Route::get('/', [PostController::class, 'index']);

Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::post('posts/{post:slug}/comment', [CommentController::class, 'store'])->middleware('auth');
Route::post('comment-delete/{comment}', [CommentController::class, 'destroy'])->middleware('auth');

Route::get('register', [RegistrationController::class, 'create'])->middleware('guest');
Route::post('register', [RegistrationController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', function() {

    $attributes = request()->validate([
        'email' => ['required', 'email']
    ]);

    $mailchimp = new ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us14'
    ]);

    $list = $mailchimp->lists->getAllLists()->lists[0];

    try {
        $mailchimp->lists->addListMember($list->id, [
            "email_address" => $attributes['email'],
            "status" => "subscribed",
        ]);

        return back()->with('success','You\'ve subscribed to updates');

    } catch (GuzzleHttp\Exception\ClientException $e) {
        $error =  json_decode($e->getResponse()->getBody()->getContents());
        throw ValidationException::withMessages(['email' => $error->title]);
    } catch (Exception $e) {
        throw ValidationException::withMessages(['email' => 'Error when subscribing']);
    }

});
