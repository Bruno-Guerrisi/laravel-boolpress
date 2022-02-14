<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
/* use Carbon\Carbon; */
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    
    public function index() {

        $posts = Post::paginate(3);

        return response()->json($posts);
    }

    public function show($slug) {

        $post = Post::where('slug', $slug)
                    ->with(['category', 'tags'])
                    ->first();


        if (! $post) {
            $post['not_found'] = true;
        }
        else if ($post->cover) {

            $post->cover = url('storage/' . $post->cover);
        }
        
        $post['date_formatted'] = $post['created_at']->format('l d/m/y');

        return response()->json($post);
    }
}
