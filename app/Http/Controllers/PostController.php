<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Post::with('author', 'tags', 'category')->latest()->get();
        // $posts = Post::with('author', 'tags', 'category')->latest()->paginate(6);
        $posts = Post::latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', [
            "post" => new Post(),
            "categories" => Category::get(),
            "tags" => Tag::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:35',
            'body' => 'required',
            'thumbnail' => 'image|mimes:jpg,png,jpeg',
            'category' => 'required',
            'tags' => 'array|required'
        ]);

        $slug = Str::slug($request->title);
        $validatedData['slug'] = $slug;

        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store('images/posts') : null;
        // if(request()->file('thumbnail')) {
        //     $thumbnail = request()->file('thumbnail')->store("images/posts");
        // } else {
        //     $thumbnail = null;
        // }

        $validatedData['category_id'] = request('category');
        $validatedData['thumbnail'] = $thumbnail;

        $post = auth()->user()->posts()->create($validatedData);

        $post->tags()->attach(request('tags'));

        session()->flash('success', 'Postingan berhasil dibuat.');
        session()->flash('error', 'Postingan gagal dibuat.');

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // fetching data dengan kategori yang sama
        // $posts = Post::with('author', 'tags', 'category')->where('category_id', $post->category_id)->latest()->limit(6)->get();
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        return view('posts.show', compact('post', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // $this->authorize('update', $post);
        if(request()->file('thumbnail')){
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        } else {
            $thumbnail = $post->thumbnail;
        }

        $validatedData = $request->validate([
            'title' => 'required|min:3|max:35',
            'thumbnail' => 'image|mimes:jpg,png,jpeg',
            'body' => 'required'
        ]);

        $validatedData['category_id'] = request('category');
        $validatedData['thumbnail'] = $thumbnail;

        $post->update($validatedData);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'Postingan berhasil diedit.');
        session()->flash('error', 'Postingan gagal diedit.');

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'Postingan berhasil dihapus.');
        return redirect('/posts');
    }
}
