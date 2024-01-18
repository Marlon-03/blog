<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Request $request) 
    {
        if ($request->category){
            return PostResource::collection(Category::where('name', $request->category)->firstOrFail()->posts()->where('status', 2)->latest()->paginate(4)->withQueryString());
        }
    
        else if ($request->search){
            return PostResource::collection(Post::where('status', 2)->where(function($query) use ($request) {
                $query->where('title', 'LIKE', '%'.$request->search.'%')
                      ->orWhere('body', 'LIKE', '%'.$request->search.'%');
            })->latest()->paginate(4)->withQueryString());
        }
        return PostResource::collection(Post::where('status', 2)->latest()->paginate(4));
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
        if (auth()->user()->id !== $post->user_id){
            return abort(403);
        }
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id !== $post->user_id){
            return abort(403);
        }
        $request->validate([
            'title' => 'required',
            'file' => 'nullable | image',
            'body' => 'required',
            'category_id' => 'required',
        ]);
    
        $title = $request->title;
        $category_id = $request->category_id;
    
        $slug = Str::slug($title, '-').'-'.$post->id;
        $user_id = auth()->user()->id;
        $body = $request->input('body');
        
        if ($request->file('file')){
            File::delete($post->imagePath);
            $imagePath = '/storage/'.$request->file('file')->store('postsImages', 'public');
            $post->imagePath = $imagePath;
        } else {
            $imagePath = $post->imagePath;
        }
    
        $post->title = $title;
        $post->category_id = $category_id;
        $post->slug = $slug;
        $post->user_id = $user_id;
        $post->body = $body;
        $post->imagePath = $imagePath;
        $post->save();
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id !== $post->user_id){
            return abort(403);
        }

        return $post->delete();
    }

    public function adminPosts()
    {
        $posts = Post::with('category')->latest()->get();
        return PostResource::collection($posts);
    }

    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:0,1,2',
        ]);
        $post = Post::findOrFail($id);
        $post->status = $request->status;
        $post->save();

        return response()->json(['message' => 'Post status updated.']);
    }

}
