@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bewerk Profiel</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Naam</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">Verjaardag</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Over mij</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" required>{{ $user->bio }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="avatar" class="form-label">Avatar</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                            @if ($user->avatar)
                                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Current Avatar" class="mt-3" width="150">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
