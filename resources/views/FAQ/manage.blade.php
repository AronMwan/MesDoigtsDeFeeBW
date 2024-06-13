@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FAQ Management</h1>
    <a href="{{ route('faq.create') }}" class="btn btn-primary mb-3">Add FAQ</a>
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td>
                    <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('faq.destroy', $faq->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
