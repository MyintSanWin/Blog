<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
   public function create(){
       return view('register.create');
   }

   public function store(){


      $attribute = request()->validate([
           'name' => 'required|max:255',
           'username' => 'required|min:3|max:12|unique:users,username',//check unique
           'email' => 'required|email|max:255|unique:users,email',//check unique
           'password'=>'required|min:8|max:255'
       ]);


      $user = User::create($attribute);
       Auth::login($user);
      //go to layout.blade.php
       return redirect('/')->with('success', 'Your account has been created');
   }
}
