@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kledingstukken</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($posts as $post)
                    @if ($post->cover_image != 'noimage.jpg')
        <img src="/storage/{{ $post->cover_image }}" alt="{{ $post->title }}" class="img-fluid">
    @endif
                        <h3><a href="{{route('posts.show', $post->id)}}">{{ $post->title }}</a></h3>
                        <small>Gepost door <a href="{{route('profile', $post->user->name)}}">{{ $post->user->name }}</small></a>
                        <small>op {{ $post->created_at->format('d/m/Y \o\m H:i') }}</small>
                        @auth
                        @if($post->user->id == Auth::id())
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Bewerk</a>
                      
                        @else
                            <form method="POST" action="{{ route('like', $post->id) }}" style="display:inline;">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-primary">Like</button>
                            </form>

                            @endif
                            
                        @endauth

                        @auth
                        @if(Auth::user()->is_admin)
                            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" style="display:inline;" onclick="return confirm('Are you sure want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Verwijder</button>
                            </form>
                            @endif
                        @endauth
                        <br>
                        {{$post->likes->count()}} likes
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
