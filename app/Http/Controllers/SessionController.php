<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //
    function destroy(){
       Auth::logout();

       return redirect('/')->with('success', 'Goodbye!');
    }
}
