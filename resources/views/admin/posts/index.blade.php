@extends('layouts.app')

@section('content')

    <section class="container">

        <h1>Posts</h1>

        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }} deleted successfully!
            </div>
        @endif


        @if ($posts->isEmpty())
            <h3>No results</h3>

        @else

            <div class="row">
                @foreach ($posts as $post)

                <div class="col-4 mb-4 h-100">
                    <div class="card text-center">
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

                        <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-primary">View all</a>
                    </div>
                </div>

                @endforeach
            </div>
            
        @endif

    </section>

@endsection

