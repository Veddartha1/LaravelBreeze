<?php

namespace App\Http\Controllers;

use App\Http\Requests\GangaRequest;
use App\Models\Category;
use App\Models\Ganga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $gangas = Ganga::orderBy('likes', 'DESC')->orderBy('unlikes', 'ASC')->paginate(10);
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
    public function store(GangaRequest $request)
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
            $destinationPath = 'storage/img';
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

        if (Auth::user()->rols('admin') || Auth::id() === $ganga->user->id) {
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
    public function update(GangaRequest $request, $id)
    {
        $ganga = Ganga::findOrFail($id);
        if (Auth::user()->rols()->first()->pivot->rol_id === 1 || Auth::id() === $ganga->user->id) {
            $ganga->title = $request->title;
            $ganga->description = $request->description;
            $ganga->url = $request->url;
            $ganga->category_id = $request->category_id;
            $ganga->price = $request->price;
            $ganga->price_sale = $request->price_sale;
            $ganga->available = $request->available ? 1 : 0;
            $ganga->save();

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $destinationPath = 'storage/img';
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
        if (Auth::user()->rols()->first()->pivot->rol_id === 1 || Auth::id() === $ganga->user->id) {
            $ganga->delete();
        }

        return redirect()->route('index');
    }

    public function like(Request $request)
    {
        if (Auth::id() != 0) {
            $ganga = Ganga::findOrFail($request->id);
            $userVoted = DB::select('SELECT * from likes where user_id = ' . Auth::id() . ' AND ganga_id = ' . $ganga->id);
            if ($userVoted) {
                if ($ganga->likes()->first()->pivot->liked === 0) {
                    $ganga->likes()->updateExistingPivot(Auth::id(), [
                        'unliked' => 0,
                        'liked' => 1,
                    ]);
                    $ganga->likes ++;
                    $ganga->unlikes --;
                    $ganga->save();
                }
            } else {
                $ganga->likes()->attach(Auth::id());
                $ganga->likes()->updateExistingPivot(Auth::id(), [
                    'liked' => 1,
                ]);
                $ganga->likes ++;
                $ganga->save();
            }
        }
        return redirect()->back();
    }

    public function unlike(Request $request)
    {
        if (Auth::id() != 0) {
            $ganga = Ganga::findOrFail($request->id);
            $userVoted = DB::select('SELECT * from likes where user_id = ' . Auth::id() .' AND ganga_id = ' . $ganga->id);
            if ($userVoted) {
                if ($ganga->likes()->first()->pivot->unliked === 0) {
                    $ganga->likes()->updateExistingPivot(Auth::id(), [
                        'unliked' => 1,
                        'liked' => 0,
                    ]);
                    $ganga->likes --;
                    $ganga->unlikes ++;
                    $ganga->save();
                }
            } else {
                $ganga->likes()->attach(Auth::id());
                $ganga->likes()->updateExistingPivot(Auth::id(), [
                    'unliked' => 1,
                ]);
                    $ganga->unlikes ++;
                    $ganga->save();
            }
        }

        return redirect()->back();
    }
}
