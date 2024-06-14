@extends('layouts.admin_app')

@section('content')
<div class="container">
    <h1>Add FAQ Category</h1>
    <form id="faq-categoriesForm"action="{{ route('faq-categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add</button>
    </form>
</div>
@endsection
<script>
    document.getElementById('faq-categoriesForm').addEventListener('submit', function(event) {
        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        this.classList.add('was-validated');
    }, false);
</script>