<?php

namespace App\Http\Controllers\Content;

use App\Admin\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index($slug)
    {
        if($post = Post::where('slug', $slug)->first()) {
            return view('content.post', compact('post'));
        } else {
            abort(404);
        }
    }
}
