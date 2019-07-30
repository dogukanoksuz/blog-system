<?php

namespace App\Http\Controllers\Content;

use App\Admin\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index($slug)
    {
        if ($category = Category::where('slug', $slug)->first()) {
            $posts = $category->post()->orderBy('created_at', 'desc')->paginate(5);
            return view('content.category', compact(['posts', 'category']));
        } else {
            abort(404);
        }
        //return view('content.category', compact(['posts', 'category']));
    }
}
