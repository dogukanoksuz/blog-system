<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Admin\Post;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('title', 'id')->all();
        $i = 0;
        $categorySelect = [];

        foreach ($categories as $key => $val) {
            $categorySelect[$i]['text'] = $val;
            $categorySelect[$i]['value'] = $key;
            $categorySelect[$i]['is_checked'] = 0;
            $i++;
        }

        return view('admin.posts_create', compact(['categories', 'categorySelect']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request,
                [
                    'title' => 'required',
                    'content' => 'required',
                    'categories' => 'required'
                ]
            );
        } catch (ValidationException $e) {
            $error = 'Hata! ' . $e->getMessage();
            $posts = Post::orderBy('created_at', 'desc')->paginate(15);
            return view('admin.posts', compact(['posts', 'error']));
        }

        $post = Post::create(
            [
                'title' => $request->title,
                'content' => $request->content,
                'seo_description' => $request->seo_description
            ]
        );

        if ($request->filepath !== null) {
            $newImg = Image::make(public_path($request->filepath))->fit(720, 480)->encode('jpg', 40)->save(public_path('/images/thumbs/' . $post->slug . '-' . time() . '.jpg'));

            $post->update(
                [
                    'thumbnail_path' => '/images/thumbs/' . $post->slug . '-' . time() . '.jpg'
                ]
            );
        }

        foreach ($request->categories as $key => $val) {
            $post->category()->attach($val);
        }

        $post->user()->attach(Auth::id());

        $tags = explode(',', $request->tags);
        $post->attachTags($tags);

        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        $error = 'Başarıyla kaydedildi!';
        return view('admin.posts', compact(['posts', 'error']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $categories = Category::pluck('title', 'id')->all();
        $i = 0;
        $categorySelect = [];

        foreach ($categories as $key => $val) {
            $categorySelect[$i]['text'] = $val;
            $categorySelect[$i]['value'] = $key;
            $categorySelect[$i]['is_checked'] = $post->isElementOfThisCategory($key);
            $i++;
        }

        return view('admin.posts_edit', compact(['post', 'categorySelect']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request,
                [
                    'title' => 'required',
                    'content' => 'required',
                    'categories' => 'required'
                ]
            );
        } catch (ValidationException $e) {
            $error = 'Hata! ' . $e->getMessage();
            $posts = Post::orderBy('created_at', 'desc')->paginate(15);
            return view('admin.posts', compact(['posts', 'error']));
        }

        $post = Post::find($id);
        $post->update(
            [
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $request->slug
            ]
        );

        DB::table('post_category')->where('post_id', $id)->delete();

        if ($request->filepath !== null) {
            $newImg = Image::make(public_path($request->filepath))->fit(720, 480)->encode('jpg', 40)->save(public_path('/images/thumbs/' . $post->slug . '-' . time() . '.jpg'));

            $post->update(
                [
                    'thumbnail_path' => '/images/thumbs/' . $post->slug . '-' . time() . '.jpg'
                ]
            );
        }

        foreach ($request->categories as $key => $val) {
            $post->category()->attach($val);
        }

        $tags = explode(',', $request->tags);
        $post->syncTags($tags);


        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        $error = 'Başarıyla düzenlendi!';
        return view('admin.posts', compact(['posts', 'error']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Post::destroy($id);
            DB::table('post_category')->where('post_id', $id)->delete();
            DB::table('post_user')->where('post_id', $id)->delete();

            $error = 'Başarıyla silindi!';
        } catch (QueryException $e) {
            $error = 'Hata!' . $e;
        }

        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.posts', compact(['posts', 'error']));
    }
}
