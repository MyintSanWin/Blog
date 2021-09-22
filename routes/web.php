<?php

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\Environment\Console;
use SebastianBergmann\Environment\Runtime;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Symfony\Component\VarDumper\VarDumper;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
        
        return view('posts',[
            'posts'=> Post::all()
        ]);
   
});

Route::get('posts/{post:slug}',function(Post $post){
    
  return view('post',[
      'post'=> $post
  ]); 
});

Route::get('categories/{category}', function (Category $category){
  return view('posts', [
    'posts' => $category->posts
  ]);
});

