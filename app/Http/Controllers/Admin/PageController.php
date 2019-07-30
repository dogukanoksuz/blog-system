<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Page;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(15);
        return view('admin.pages', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages_create');
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
        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required'
            ]
        );

        $page = Page::create(
            [
                'title' => $request->title,
                'content' => $request->content
            ]
        );

        $page->user()->attach(Auth::id());

        $pages = Page::paginate(15);
        $error = 'Başarıyla kaydedildi!';
        return view('admin.pages', compact(['pages', 'error']));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);

        return view('admin.pages_edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'title' => 'required',
                'content' => 'required'
            ]
        );

        $page = Page::find($id);
        $page->update(
            [
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $request->slug
            ]
        );

        $pages = Page::paginate(15);
        $error = 'Başarıyla düzenlendi!';
        return view('admin.pages', compact(['pages', 'error']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Page::destroy($id);
            DB::table('page_user')->where('page_id', $id)->delete();
            $error = 'Başarıyla silindi!';
        } catch (QueryException $e) {
            $error = 'Hata!' . $e;
        }

        $pages = Page::paginate(15);
        return view('admin.pages', compact(['pages', 'error']));
    }
}
