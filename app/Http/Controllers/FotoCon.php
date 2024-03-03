<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlbumModel;
use App\Models\FotoModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FotoCon extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $albums = AlbumModel::all();
        $fotos = FotoModel::all();
        $users = User::all();

        return view('foto', compact('fotos', 'albums', 'users'));
    }

    public function create()
    {
        return view('foto');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,png.jpeg',
            'album_id' => 'required|exists:albums,id'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        FotoModel::create([
            'title' => $request->title,
            'image' => $imageName,
            'user_id' => Auth::id(),
            'album_id' => $request->album_id,
        ]);

        return redirect()->back()->with('success', 'FotoModel berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $fotos = FotoModel::find($id);
        return view('foto', compact('fotos'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $fotos = FotoModel::findOrFail($id);
        $fotos->title = $request->title;
        if ($request->hasFile('image')) {
            if ($fotos->image) {
                unlink(public_path('images/' . $fotos->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $fotos->image = $imageName;
        }

        $fotos->save();

        return redirect()->back()->with('success', 'FotoModel berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $fotos = FotoModel::findOrFail($id);
        $fotos->delete();

        return redirect()->back()->with('success', 'FotoModel berhasil dihapus');
    }

    public function like($id)
    {
        $fotos = FotoModel::find($id);

        if ($fotos) {
            $userlike = $fotos->user_like ?? [];

            if (in_array(auth()->user()->id, $userlike)) {
                $userlike = array_diff($userlike, [auth()->user()->id]);
                $fotos->update([
                    'like' => $fotos->like - 1,
                    'user_like' => $userlike
                ]);
            } else {
                $userlike[] = auth()->user()->id;
                $fotos->update([
                    'like' => $fotos->like + 1,
                    'user_like' => $userlike
                ]);
            }
        }

        return redirect()->back();
    }
}
