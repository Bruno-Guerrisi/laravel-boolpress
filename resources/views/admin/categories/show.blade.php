@extends('layouts.app')

@section('content')

    <section class="container">

        <h1 class="mb-5">Post Categories</h1>

        @foreach ($category->posts as $post)

        <div class="card text-center mb-4">
            <div class="card-header">
                <h5 class="card-title">{{$post->title}}</h5>
            </div>
            <div class="card-body">
                <p class="card-text">{{ Str::limit( $post->content , 120, '...') }}</p>
            </div>
            <div class="card-footer">
                    
                @if ($post->category)

                <a href="{{ route('admin.category', $post->category->id)}}">
                    {{$post->category->name}}
                </a>
                
                @else No category @endif
            </div>

        </div>

        @endforeach

    </section>

@endsection

