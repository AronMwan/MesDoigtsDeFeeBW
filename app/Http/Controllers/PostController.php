<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Auth; 


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
        ]);

        $post = new Post;
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();    
    
        return redirect()->route('index')->with('status', 'Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if($post->user_id != Auth::user()->id){
            abort(403);
        }
        return view('posts.edit', compact('post'));
    }   

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',
        ]);

        $post = Post::findOrFail($id);
        if($post->user_id != Auth::user()->id){
            abort(403);
        }
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();    
    
        return redirect()->route('index')->with('status', 'Post updated successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('index')->with('status', 'Post deleted successfully');
    }
}
