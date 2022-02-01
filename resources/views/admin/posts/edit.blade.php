@extends('layouts.app')

@section('content')

    <section class="container">

        <h1 class="mb-5">Edit post</h1>

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">

                <label for="title" class="form-label">Title</label>

                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}">
            </div>

            <div class="mb-3">

                <label for="content" class="form-label">Content</label>

                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <textarea id="content" name="content" class="form-control" row="4">{{ old('title', $post->content)}}</textarea>
            </div>
    
            <button type="submit" class="btn btn-success">Seend</button>
        
        </form>


    </section>

@endsection

