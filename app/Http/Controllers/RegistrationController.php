<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Whoops\Run;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create', []);
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'username' => ['required', 'max:255', 'min:3', Rule::unique('users', 'username')],
            'email' => ['required', 'max:255', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'max:255', 'min:7'],
        ]);

        User::query()->create($attributes);

        return redirect('/')->with('success', 'Your user has been registered');
    }
}
