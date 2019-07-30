<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories_create');
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
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);

        $category = Category::create($request->all());

        $categories = Category::paginate(15);
        $error = 'Başarıyla kaydedildi!';
        return view('admin.categories', compact(['categories', 'error']));
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
        $category = Category::find($id);
        return view('admin.categories_edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $req = $request->all();

        Category::find($id)->update([
            'title' => $req['title'],
            'slug' => $req['slug'],
        ]);

        $categories = Category::paginate(15);
        $error = 'Başarıyla düzenlendi!';

        return view('admin.categories', compact(['categories', 'error']));
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
            Category::destroy($id);
            $error = 'Başarıyla silindi!';
        } catch (QueryException $e) {
            $error = 'Hata!' . $e;
        }

        $categories = Category::paginate(15);
        return view('admin.categories', compact(['categories', 'error']));
    }
}
