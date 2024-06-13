<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;



class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    public function index()
    {
        //$posts = Post::latest()->get();

        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
            'cover_image' => 'nullable|image|max:1999',
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

        return redirect()->route('index')->with('status', 'Post created successfully');
    }

    public function update(Request $request, $id)
    {
    $validated = $request->validate([
        'title' => 'required|min:3',
        'content' => 'required|min:10',
        'cover_image' => 'nullable|image|max:1999',
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

        return redirect()->route('index')->with('status', 'Post updated successfully');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id != Auth::user()->id){
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }   

    

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $likes = Like::where('post_id', '=', $post->id)->delete();
        $post->delete();

        return redirect()->route('index')->with('status', 'Post deleted successfully');
    }
}
