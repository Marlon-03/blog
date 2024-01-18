<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() 
    {
        return PostResource::collection(Post::where('status', 2)->latest()->paginate(4));
    }
}
