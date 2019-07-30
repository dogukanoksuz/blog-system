<?php

namespace App\Http\Controllers\Content;

use App\Admin\Category;
use App\Admin\Page;
use App\Admin\Post;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Spatie\Tags\Tag;

class SitemapController extends Controller
{
    public function sitemap()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        $pages = Page::get();
        $categories = Category::get();
        $tags = Tag::get();
        $now = Carbon::now()->toAtomString();
        $content = view('content.sitemap', compact(['posts', 'pages', 'categories', 'tags'], 'now'));
        return response($content)->header('Content-Type', 'application/xml');
    }
}
