<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye');
    }

    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);


        if (auth()->attempt($credentials)) {
            session()->regenerate();
            return redirect('/')->with('success', 'Welcome back!');
        }

        throw ValidationException::withMessages(['email' => 'Your credentials have not been registered yet']);

/*        return back()
            ->withInput()
            ->withErrors(
                ['email' => 'Your credentials have not been registered yet']
            );*/
    }
}
