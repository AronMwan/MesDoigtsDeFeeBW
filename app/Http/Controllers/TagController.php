<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        $tag = new Tag;
        $tag->name = $validated['name'];
        $tag->save();

        return redirect()->route('tags.index')->with('status', 'Tag created successfully');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name = $validated['name'];
        $tag->save();

        return redirect()->route('tags.index')->with('status', 'Tag updated successfully');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('status', 'Tag deleted successfully');
    }
}
