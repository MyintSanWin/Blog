<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Response as FacadesResponse;
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

    //index, show, create, store, edit , update, destroy
}
