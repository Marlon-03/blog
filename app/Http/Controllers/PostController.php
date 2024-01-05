<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index() 
    {
        $posts = Post::with('category')->latest()->get();

        return PostResource::collection($posts);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required | image',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        $title = $request->title;
        $category_id = $request->category_id;

        if (!Post::count()){
            $PostId = 1;
        }else{
            $PostId = Post::latest()->first()->id + 1;
        }

        $slug = Str::slug($title, '-').'-'.$PostId;
        $user_id = auth()->user()->id;
        $body = $request->input('body');
        $imagePath = '/storage/'.$request->file('file')->store('postsImages', 'public');

        $post = new Post();
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->body = $body;
        $post->imagePath = $imagePath;
        $post->save();
    }
    public function show(Post $post){
        return new PostResource($post);
    }
}
