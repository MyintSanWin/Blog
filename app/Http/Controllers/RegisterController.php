<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
   public function create(){
       return view('register.create');
   }

   public function store(){


      $attribute = request()->validate([
           'name' => 'required|max:255',
           'username' => 'required|min:3|max:3|unique:users,username',//check unique
           'email' => 'required|email|max:255|unique:users,email',//check unique
           'password'=>'required|min:8|max:255'
       ]);


       User::create($attribute);
       return redirect('/');
   }
}
