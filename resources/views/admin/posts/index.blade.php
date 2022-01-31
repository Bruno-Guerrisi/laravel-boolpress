@extends('layouts.app')

@section('content')

    <section class="container">

        <h1>Posts</h1>

        @if ($posts->isEmpty())
            <h3>No results</h3>

        @else

            <div class="row">
                @foreach ($posts as $post)

                <div class="col-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h5 class="card-title">{{$post->title}}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{$post->content}}</p>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            
        @endif

    </section>

@endsection

