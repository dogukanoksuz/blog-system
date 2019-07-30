<?php

namespace App\Http\Controllers\Content;

use App\Admin\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->searchQuery;
        $posts = Post::query()
                    ->where('title', 'LIKE', "%{$request->searchQuery}%")
                    ->orWhere('content', 'LIKE', "%{$request->searchQuery}%")
                    ->paginate(5);

        return view('content.search', compact(['posts', 'title']));
    }
}
