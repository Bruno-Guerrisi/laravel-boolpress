@extends('layouts.app')

@section('content')

    <section class="container">

        <h1 class="mb-5">This is your Post</h1>

        <div class="row text-center mb-5">

            <h1 class="w-100 mb-3">{{ $post->title}}</h1>

            <p>
                {{ $post->content}}
            </p>
        </div>

        <div class="row justify-content-between">

            <div>
                <a href="{{ route('admin.posts.index')}}" class="btn btn-primary">Back to Posts</a>
            </div>

            <div class="d-flex">
                <a href="" class="btn btn-warning">Edit</a>

                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>

    </section>

@endsection

