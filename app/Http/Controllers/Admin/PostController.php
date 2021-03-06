<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        $tags = Tag::all();


        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation_roles(), $this->validation_message());

        $data = $request->all();

        if (array_key_exists('cover', $data)) {
            
            $img_result = Storage::put('all-covers', $data['cover']);

            $data['cover'] = $img_result;

        }
        

        $new_post = new Post();

        $slug = Str::slug($data['title'], '-');
        $count = 1;
        

        while (Post::where('slug', $slug)->first()) {
            $slug .= '-' .$count;
            $count++;
        }
        $data['slug'] = $slug;

        $new_post->fill($data);

        $new_post->save();

        /* salvataggio in pivot */

        if (array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $new_post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        

        if ( ! $post ) {
            abort(404);
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate($this->validation_roles(), $this->validation_message());

        $data = $request->all();

        $post = Post::find($id);

        if (array_key_exists('cover', $data)) {
            
            if($post->cover){
                Storage::delete($post->cover);
            }

            $data['cover'] = Storage::put('all-covers', $data['cover']);
        }


        if ($data['title'] != $post->title) {
            
            $slug = Str::slug($data['title'], '-');
            $count = 1;
            $base_slug = $slug;

            while (Post::where('slug', $slug)->first()) {
                $slug =$base_slug . '-' . $count;
                $count++;
            }
            
            $data['slug'] = $slug;
            
        }else {

            $data['slug'] = $post->slug;
        }

        $post->update($data);

        //update pivot table
        if (array_key_exists('tags', $data)) {

            /* update checkbox */
            $post->tags()->sync($data['tags']);
        } else {

            /* nessun checkbox */
            $post->tags()->detach();
        }
        

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->cover) {
            Storage::delete($post->cover);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }

    private function validation_roles() {
        return [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|file|mimes:jpg,jpeg,png,bmp',
        ];
    }

    private function validation_message() {
        return [
            'required' => 'this fild is required',
        ];
    }
}
