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

            <div class="mb-3">

                <label for="category_id" class="form-label">Category</label>

                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <select class="form-control" name="category_id" id="category_id">

                    <option value=""
                    @if ( $post->category_id == Null ) selected @endif>without category</option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                                @if ($category->id == old('category_id', $post->category->id) ) selected
                                @endif>
                                
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>
            </div>
    
            <button type="submit" class="btn btn-success">Seend</button>
        
        </form>


    </section>

@endsection

