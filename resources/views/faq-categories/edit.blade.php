@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit FAQ Category</h1>
    <form action="{{ route('faq-categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
