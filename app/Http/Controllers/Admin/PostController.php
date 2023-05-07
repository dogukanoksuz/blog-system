<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request,
                [
                    'title' => 'required',
                    'content' => 'required',
                    'categories' => 'required',
                ]
            );
        } catch (ValidationException $e) {
            $error = 'Hata! '.$e->getMessage();
            $posts = Post::orderBy('created_at', 'desc')->paginate(15);

            return view('admin.posts', compact(['posts', 'error']));
        }

        $post = Post::create(
            [
                'title' => $request->title,
                'content' => $request->content,
                'seo_description' => $request->seo_description,
            ]
        );

        $filepath = str_replace(env('APP_URL'), '', (string) $request->filepath);
        $filepath = '/home/dogukan.dev/public_html'.$filepath;

        if ($request->filepath !== null) {
            try {
                $newImg = Image::make($filepath)->fit(600, 333)->encode('jpg', 40)->save('/home/dogukan.dev/public_html/images/thumbs/'.$post->slug.'-'.time().'.jpg');
            } catch (\Throwable $e) {
                return response()->json($e->getMessage());
            }

            $post->update(
                [
                    'thumbnail_path' => '/images/thumbs/'.$post->slug.'-'.time().'.jpg',
                ]
            );
        }

        foreach ($request->categories as $key => $val) {
            $post->category()->attach($val);
        }

        $tags = explode(',', (string) $request->tags);
        $post->syncTags($tags);

        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        $error = 'Başarıyla kaydedildi!';

        return view('admin.posts', compact(['posts', 'error']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request,
                [
                    'title' => 'required',
                    'content' => 'required',
                    'categories' => 'required',
                ]
            );
        } catch (ValidationException $e) {
            $error = 'Hata! '.$e->getMessage();
            $posts = Post::orderBy('created_at', 'desc')->paginate(15);

            return view('admin.posts', compact(['posts', 'error']));
        }

        $post = Post::find($id);
        $post->update(
            [
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $request->slug,
                'seo_description' => $request->seo_description,
            ]
        );

        DB::table('post_category')->where('post_id', $id)->delete();

        $filepath = str_replace(env('APP_URL'), '', (string) $request->filepath);
        $filepath = '/home/dogukan.dev/public_html'.$filepath;

        if ($request->filepath !== null) {
            try {
                $newImg = Image::make($filepath)->fit(600, 333)->encode('jpg', 40)->save('/home/dogukan.dev/public_html/images/thumbs/'.$post->slug.'-'.time().'.jpg');
            } catch (\Throwable $e) {
                return response()->json($e->getMessage());
            }

            $post->update(
                [
                    'thumbnail_path' => '/images/thumbs/'.$post->slug.'-'.time().'.jpg',
                ]
            );
        }

        foreach ($request->categories as $key => $val) {
            $post->category()->attach($val);
        }

        $tags = explode(',', (string) $request->tags);
        $post->syncTags($tags);

        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        $error = 'Başarıyla düzenlendi!';

        return view('admin.posts', compact(['posts', 'error']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Post::destroy($id);
            DB::table('post_category')->where('post_id', $id)->delete();
            DB::table('post_user')->where('post_id', $id)->delete();
            DB::table('post_tag')->where('post_id', $id)->delete();
            $error = 'Başarıyla silindi!';
        } catch (QueryException $e) {
            $error = 'Hata!'.$e;
        }

        $posts = Post::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.posts', compact(['posts', 'error']));
    }
}
