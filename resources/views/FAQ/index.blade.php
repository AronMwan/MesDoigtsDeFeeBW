@extends('layouts.app')

@section('content')
<div class="container">
    <h1>FAQ</h1>
    <div class="card">
    @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
        @foreach($category->faqs as $item)
            <div class="card-body">
                <h3>{{ $item->question }}</h3>
                <p>{{ $item->answer }}</p>
                <hr>
            </div>
        @endforeach
        
    @endforeach
    </div>  

</div>
@endsection
