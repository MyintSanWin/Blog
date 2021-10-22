<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(59)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
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

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post

        ]);
    }

    public function update(Post $post)
    {
        $attribute = request()->validate([
            'title' => 'required',
            'thumbnail' => 'image',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required',Rule::exists('categories', 'id')]
        ]);
       
        //var_dump($attribute['thumbnail']);

        if (isset($attribute['thumbnail'])) {
            $image = $attribute['thumbnail'];
            $image_name = uniqid()."_".$image->getClientOriginalname();
            $image->move(public_path('images/posts'), $image_name);
            $attribute['thumbnail']= $image_name;
        }
 
        //var_dump($attribute['thumbnail']);
        $post->update($attribute);
        return back()->with('success', 'Post Updated');
    }
}
