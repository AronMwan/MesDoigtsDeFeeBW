@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profiel van {{$user->name}}</div>

                <h2>Posts</h2>
                @foreach ($user->posts as $post)
                    <a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a>

                    @endforeach
                    


                <h2>Likes</h2>   
                @foreach ($user->likes as $like)
                    <a href="{{route('posts.show', $like->post_id)}}">{{ $like->post->title }}</a>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
