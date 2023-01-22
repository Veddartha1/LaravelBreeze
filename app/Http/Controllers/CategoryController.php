<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(5);
        return view('categorias.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('categorias.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->image = $request->image->getClientOriginalName();
        $category->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $destinationPath = 'storage/img';
            $fileName = $request->image->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
        }

        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        if (Auth::user()->rols('admin')) {
            return view('categorias.edit', compact('category'));
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if (Auth::user()->rols()->first()->pivot->rol_id === 1) {
            $category->name = $request->name;
            $category->image = $request->image->getClientOriginalName();
            $category->save();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $destinationPath = 'storage/img';
                $fileName = $request->image->getClientOriginalName();
                $request->file('image')->move($destinationPath, $fileName);
            }
        }
        return redirect()->route('categorias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if (Auth::user()->rols()->first()->pivot->rol_id === 1) {
            $category->delete();
        }

        return redirect()->route('categorias.index');
    }
}
