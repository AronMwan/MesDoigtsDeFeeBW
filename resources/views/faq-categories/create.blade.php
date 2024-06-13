@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add FAQ Category</h1>
    <form action="{{ route('faq-categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
</div>
@endsection