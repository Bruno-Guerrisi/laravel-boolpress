@extends('layouts.app')

@section('content')

    <section class="container">

        <h1 class="mb-5">Create a new post</h1>

        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf


            {{-- name --}}
            <div class="mb-3">

                <label for="title" class="form-label">Title</label>

                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <input type="text" id="title" name="title" placeholder="Insert the title" class="form-control" value="{{ old('title') }}">
            </div>


            {{-- content --}}
            <div class="mb-3">

                <label for="content" class="form-label">Content</label>

                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <textarea id="content" name="content" placeholder="Insert the content" class="form-control" row="4">{{ old('content') }}</textarea>
            </div>

            {{-- categories --}}
            <div class="mb-3">

                <label for="category_id" class="form-label">Category</label>

                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <select class="form-control" name="category_id" id="category_id">
                    <option value="Unsigned">without category</option>
                    @foreach($categories as $category)

                        <option value="{{ $category->id }}" 
                                @if ($category->id == old('category_id') ) selected @endif>
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            {{-- tags --}}
            <div class="mb-3">
                <h3>Tags</h3>

                @foreach ($tags as $tag)

                <span class="d-inline-block mr-3">

                    <input type="checkbox" name="tags[]" 
                            id="tag{{ $loop->iteration }}" 
                            value="{{ $tag->id }}"

                            @if( in_array( $tag->id, old( 'tags', [] ) ) ) checked @endif>

                    <label for="tag{{ $loop->iteration }}">
                        {{ $tag->name }}
                    </label>
                </span>

                @endforeach
            </div>


            {{-- image --}}
            <div class="mb-3">
                <h4>Image</h4>

                @error('cover')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <span class="d-inline-block mt-3">

                    <label class="form-label" for="cover">Post Image</label>

                    <input class="form-control-file" type="file" name="cover" id="cover">

                </span>


            </div>
    
            {{-- submit --}}
            <button type="submit" class="btn btn-success">Seend</button>
        
        </form>


    </section>

@endsection

