<?php

namespace App\Http\Controllers\Content;

use App\Admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index($slug)
    {
        if ($page = Page::where('slug', $slug)->first())
        {
            return view('content.page', compact('page'));
        } else {
            abort(404);
        }
    }
}
