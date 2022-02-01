@extends('layouts.app')

@section('content')

    <section class="container">

        <h1 class="mb-5">Create a new post</h1>

        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf

            <div class="mb-3">

                <label for="title" class="form-label">Title</label>

                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <input type="text" id="title" name="title" placeholder="Insert the title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="mb-3">

                <label for="content" class="form-label">Content</label>

                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <textarea id="content" name="content" placeholder="Insert the content" class="form-control" row="4">{{ old('content') }}</textarea>
            </div>
    
            <button type="submit" class="btn btn-success">Seend</button>
        
        </form>


    </section>

@endsection

