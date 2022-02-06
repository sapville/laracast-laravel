<?php

namespace App\Http\Controllers;

use App\Models\User;

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
            'username' => ['required', 'max:255', 'min:3'],
            'email' => ['required', 'max:255', 'email'],
            'password' => ['required', 'max:255', 'min:7'],
        ]);

        User::query()->create($attributes);

        return redirect('/');
    }
}
