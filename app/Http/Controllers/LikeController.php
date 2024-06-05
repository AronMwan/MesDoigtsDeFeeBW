<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  public function like($post_id, Request $request)
  {

    $post = Post::findOrFail($post_id);
    if($post->user_id == Auth::user()->id){
      abort(403, 'You cannot like your own post');
    }

    $like = Like::where('user_id', Auth::user()->id)->where('post_id', $post_id)->first();

    if($like != NULL){
      return redirect()->route('posts.index')->with('status', 'Post already liked');
    }
    $like = new Like;
    $like->user_id = Auth::user()->id;
    $like->post_id = $post_id;
    $like->save();

    

    return redirect()->route('posts.index')->with('status', 'Post liked successfully');
  }
}
