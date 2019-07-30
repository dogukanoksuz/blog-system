<?php

namespace App\Http\Controllers\Content;

use App\Admin\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('content.index', compact('posts'));
    }
}
