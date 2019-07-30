<?php

namespace App\Http\Controllers\Content;

use App\Admin\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Tags\Tag;

class TagController extends Controller
{
    public function index($slug)
    {
        if($tag = Tag::findFromSlug($slug)) {
            $posts = Post::withAnyTagsOfAnyType($tag->name)->paginate(5);
            return view('content.tag', compact(['posts', 'tag']));
        } else {
            abort(404);
        }
    }
}
