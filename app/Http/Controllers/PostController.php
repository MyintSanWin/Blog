<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Validation\Rule;
use SebastianBergmann\Environment\Console;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
       
        'posts'=> Post::latest()->filter(
            request(['search', 'category', 'author'])
        )->paginate(6)->withQueryString()
        

    ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post'=> $post
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $attribute = request()->validate([
           'title' => 'required',
           'thumbnail' => 'required|image',
           'slug' => ['required', Rule::unique('posts', 'slug')],
           'excerpt' => 'required',
           'body' => 'required',
           'category_id' => ['required',Rule::exists('categories', 'id')]
       ]);

    
        $post = new Post;
        $post->title = $attribute['title'];
        $image = request('thumbnail');
        $image_name = uniqid()."_".$image->getClientOriginalname();
        $image->move(public_path('images/posts'), $image_name);
        $post->thumbnail = $image_name;
        $post->slug = $attribute['slug'];
        $post->excerpt = $attribute['excerpt'];
        $post->body = $attribute['body'];
        $post->category_id = $attribute['category_id'];
        $post->user_id = Auth::id();

       
        $post->save();
    
        return redirect('/')->with('success', 'Your post has been created');
    }
     
      
    

    //index, show, create, store, edit , update, destroy
}
