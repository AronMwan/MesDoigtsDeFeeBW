@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$post->title}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    @if ($post->cover_image != 'noimage.jpg')
                        <img src="/storage/{{ $post->cover_image }}" alt="{{ $post->title }}" class="img-fluid">
                        <br>
                    @endif

                    {{$post->content}}
                    <br>
                    @if($post->tags->count() > 0)
                        <p>Tags: 
                            @foreach($post->tags as $tag)
                                <span class="badge badge-secondary">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                    @endif
                    {{$post->likes->count()}} likes
                    <br>
                    @auth
                    @if($post->user->id == Auth::id() || Auth::user()->is_admin)
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Bewerk</a>
                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Verwijder</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('like', $post->id) }}" style="display:inline;">
                            @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-primary">Like</button>
                        </form>

                        @endif
                    @endauth
                    <br>
                    <small>Gepost door <a href="{{route('profile', $post->user->name)}}">{{ $post->user->name }}</a></small>
                    <small>op {{ $post->created_at->format('d/m/Y \o\m H:i') }}</small>
                        
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
