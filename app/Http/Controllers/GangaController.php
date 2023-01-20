<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ganga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gangas = Ganga::orderBy('id', 'ASC')->paginate(10);
        return view('gangas.index', compact('gangas'));
    }

    public function latest()
    {
        $gangas = Ganga::orderBy('created_at', 'DESC')->paginate(10);
        return view('gangas.index', compact('gangas'));
    }

    public function featured()
    {
        $gangas = Ganga::orderBy('likes', 'DESC')->paginate(10);
        return view('gangas.index', compact('gangas'));
    }

    public function owned()
    {
        $gangas = Ganga::orderBy('id', 'ASC')->where('user_id', Auth::id())->paginate(10);
        return view('gangas.index', compact('gangas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('gangas.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ganga = new Ganga();

        $ganga->title = $request->title;
        $ganga->description = $request->description;
        $ganga->url = $request->url;
        $ganga->category_id = $request->category_id;
        $ganga->price = $request->price;
        $ganga->price_sale = $request->price_sale;
        $ganga->likes = 0;
        $ganga->unlikes = 0;
        $ganga->available = true;
        $ganga->user_id = Auth::id();

        $ganga->save();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $destinationPath = 'public/img';
            $fileName = $ganga->id . "-ganga-severa.jpeg";
            $request->file('image')->move($destinationPath, $fileName);
        }

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ganga = Ganga::findOrFail($id);
        return view('gangas.show', compact('ganga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ganga = Ganga::findOrFail($id);
        $categories = Category::all();

        if (Auth::user()->rol === 'admin' || Auth::id() === $ganga->user->id) {
            return view('gangas.edit', compact('ganga', 'categories'));
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ganga = Ganga::findOrFail($id);

        if (Auth::user()->rol === 'admin' || Auth::id() === $ganga->user->id) {
            $ganga->title = $request->title;
            $ganga->description = $request->description;
            $ganga->url = $request->url;
            $ganga->category_id = $request->category_id;
            $ganga->price = $request->price;
            $ganga->price_sale = $request->price_sale;
            $ganga->available = $request->available;
            $ganga->save();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $destinationPath = 'public/img';
                $fileName = $ganga->id . "-ganga-severa.jpeg";
                $request->file('image')->move($destinationPath, $fileName);
            }
        }
        return redirect()->route('index','imagePath');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ganga = Ganga::findOrFail($id);

        if (Auth::user()->rol === 'admin' || Auth::id() === $ganga->user->id) {
            $ganga->delete();
        }

        return redirect()->route('index');
    }

    public function like(Request $request)
    {
        $ganga = Ganga::findOrFail($request->id);
        $ganga->likes ++;
        $ganga->save();

        return redirect()->route('index');
    }

    public function unlike(Request $request)
    {
        $ganga = Ganga::findOrFail($request->id);
        $ganga->unlikes ++;
        $ganga->save();

        return redirect()->route('index');
    }
}
