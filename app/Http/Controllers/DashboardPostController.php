<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\PostResource;
use App\Models\Post;

class DashboardPostController extends Controller
{
    public function index() 
    {
        return PostResource::collection(Post::with('category')->where('user_id', auth()->user()->id)->latest()->get());
    }
}
