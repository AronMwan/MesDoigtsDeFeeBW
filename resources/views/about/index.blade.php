@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">About</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="https://laravel.com/docs/11.x/middleware">Laravel 11 Middleware</a>
                    <a href="https://laravel.com/docs/11.x/eloquent-relationships#many-to-many">Laravel 11 Many to Many</a>
                    <a href="https://github.com/AronMwan/MesDoigtsDeFeeBW">Github</a>
                    <a href="https://www.youtube.com/watch?v=yyHeqTZEINU&t=86s">Update User Profile</a>
                    <a href="https://www.chatgpt.com">ChatGPT</a>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
