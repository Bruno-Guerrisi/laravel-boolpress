@extends('layouts.app')

@section('content')

    <section class="container">

        <h1 class="mb-5">This is your Post</h1>

        <div class="row flex-column text-center mb-5">

            {{-- title --}}
            <h1 class="w-100 mb-3">{{ $post->title}}</h1>

            <div class="d-flex">

                {{-- content --}}
                <p class="mb-2 {{$post->cover ? 'col-md-6' : 'col' }}">
                    {{ $post->content}}
                </p>

                {{-- cover --}}
                @if ($post->cover)

                    <div class="col-md-6">

                        <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                    </div>

                @endif

            </div>

            {{-- date --}}
            <div>
                <span>{{ $post->created_at->format('l d/m/y')}}</span>
            </div>

            {{-- category --}}
            <span class="d-block w-100 mb-3">Cayegory:

                @if ($post->category) {{$post->category->name}} @else No category @endif
            
            </span>

            {{-- tags --}}
            <span class="d-block w-100 mb-3">Tags: 

                    
                @if (!$post->tags->isEmpty())

                @foreach ($post->tags as $tag)
                    <span class="badge badge-primary">{{$tag->name}}</span>
                @endforeach

                @else No tags @endif
            
            </span>
        </div>

        <div class="row justify-content-between">

            <div>
                <a href="{{ route('admin.posts.index')}}" class="btn btn-primary">Back to Posts</a>
            </div>

            <div class="d-flex">
                <a href="{{ route('admin.posts.edit', $post->slug) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>

    </section>

@endsection

