@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profiel van {{ $user->name }}</div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Gebruikersnaam:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Verjaardag:</strong> {{ $user->birthday ? $user->birthday->format('d/m/Y') : 'Niet opgegeven' }}
                    </div>
                    <div class="mb-3">
                        <strong>Avatar:</strong>
                        @if($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" class="img-fluid rounded-circle" width="150">
                        @else
                            <p>Geen avatar</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <strong>Over mij:</strong> 
                        @if($user->bio)
                            {{ $user->bio }}
                        @else
                            @if(Auth::id() == $user->id)
                                <button id="addBioButton" class="btn btn-primary">Voeg Bio Toe</button>
                            @endif
                        @endif
                    </div>

                    @if(Auth::id() == $user->id)
                    <form id="bioForm" action="{{ route('updateBio', $user->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <textarea id="bioTextarea" name="bio" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Save Bio</button>
                        </div>
                    </form>
                    @endif

                    <h2>Posts</h2>
                    <ul class="list-group">
                        @foreach ($user->posts as $post)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <h2 class="mt-4">Likes</h2>
                    <ul class="list-group">
                        @foreach ($user->likes as $like)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', $like->post_id) }}">{{ $like->post->title }}</a>
                            </li>
                        @endforeach
                    </ul>

                    @if(Auth::id() == $user->id)
                    <form action="{{route('edit', $user->name)}}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-4">Bewerk Profiel</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::id() == $user->id)
<script>
    document.getElementById('addBioButton').addEventListener('click', function() {
        document.getElementById('bioForm').style.display = 'block';
        document.getElementById('addBioButton').style.display = 'none';
    });
</script>
@endif
@endsection
