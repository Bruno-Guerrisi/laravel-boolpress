<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Post;
use App\Category;

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

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();


        return view('admin.posts.create', compact('categories'));
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

        return view('admin.posts.edit', compact('post', 'categories'));
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

        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }

    private function validation_roles() {
        return [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    private function validation_message() {
        return [
            'required' => 'this fild is required',
        ];
    }
}
