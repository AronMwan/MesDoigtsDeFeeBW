@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nieuw Kledingstuk</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('posts.update', $post->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Titel</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $post->title }}" required>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end">Content</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required>{{ $post->content }}</textarea>
                                
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Wijzigen                 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
