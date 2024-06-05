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
                        <h3>{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                        <small>Gepost door {{ $post->user->name }}</small>
                        <small>op {{ $post->created_at->format('d/m/Y \o\m H:i') }}</small>
                        @auth
                        @if($post->user->id == Auth::id())
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
                        {{$post->likes->count()}} likes
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
