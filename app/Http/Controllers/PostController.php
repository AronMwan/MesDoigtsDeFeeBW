<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with('tags')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
            'cover_image' => 'nullable|image|max:1999',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        if ($request->hasFile('cover_image')) {
            $fileNameToStore = $request->file('cover_image')->store('cover_images', 'public');
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        if (!empty($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('posts.index')->with('status', 'Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user_id != Auth::user()->id) {
            abort(403);
        }
        $tags = Tag::all(); 
        return view('posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
            'cover_image' => 'nullable|image|max:1999',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $post = Post::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/' . $post->cover_image);
            }
            $fileNameToStore = $request->file('cover_image')->store('cover_images', 'public');
        } else {
            $fileNameToStore = $post->cover_image;
        }

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->cover_image = $fileNameToStore;
        $post->save();

        if (!empty($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.index')->with('status', 'Post updated successfully');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id)->with('tags');
        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        if ($post->cover_image != 'noimage.jpg') {
            Storage::delete('public/' . $post->cover_image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('status', 'Post deleted successfully');
    }
}
