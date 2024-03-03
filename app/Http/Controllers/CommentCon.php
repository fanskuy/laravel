<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentModel;

class CommentCon extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        CommentModel::create([
            'user_id' => auth()->user()->id,
            'foto_id' => $id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil diunggah.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $id = CommentModel::find($id);

        if ($id) {
            $id->delete();
        }

        return redirect()->back();
    }
}
