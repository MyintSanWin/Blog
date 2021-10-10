<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Contracts\Service\Attribute\Required;

class SessionController extends Controller
{

    public function create(){
        return view('sessions.create');
    }

    function store(){
        //validate the request
        $attributes =request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //attempt to authentication and log in the user
        //based on the provided credentials
        if(!Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'Your provided credentals could not be verified.'
            ]);
           
        }
        //session fixation
        session()->regenerate();
        //redirect with a success flash message
            return redirect('/')->with('success', 'Welcome back!  Yor are logged in');
        //auth failed
      
    }
    //
    function destroy(){
       Auth::logout();

       return redirect('/login')->with('success', 'Goodbye!');
    }
}
