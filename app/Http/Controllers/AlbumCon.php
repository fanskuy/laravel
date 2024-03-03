<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlbumModel;
use App\Models\FotoModel;

class AlbumCon extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard');
    }

    public function album()
    {
        $albums = AlbumModel::all();
        return view('album', compact('albums'));
    }

    public function create()
    {
        return view('album');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $albums = new AlbumModel();
        $albums->name = $request->input('name');
        $albums->user_id = auth()->user()->id;
        $albums->save();

        return redirect()->back()->with('success', 'Album berhasil dibuat');
    }

    public function show($album_id)
    {
        session(['album_id' => $album_id]);

        $fotos = FotoModel::where('album_id', $album_id)->get();

        return view('foto', compact('fotos', 'album_id'));
    }

    public function edit(string $id)
    {
        $albums = AlbumModel::find($id);
        return view('album', compact('albums'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $albums = AlbumModel::find($id);
        $albums->name = $request->name;
        $albums->save();

        return redirect()->back()->with('success', 'AlbumModel berhasil diubah');
    }

    public function destroy(string $id)
    {
        $albums = AlbumModel::findOrFail($id);
        $albums->delete();

        return redirect()->back()->with('success', 'Album berhasil dihapus');
    }
}
