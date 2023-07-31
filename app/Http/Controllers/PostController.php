<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
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
            'category' => 'required',
            'tags' => 'array|required'
        ]);

        $validatedData['slug'] = Str::slug($request->title);
        $validatedData['category_id'] = request('category');

        $post = Post::create($validatedData);

        // menambahkan post sekalian memasukkan request dari id tags yang diterima
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
        return view('posts.show', compact('post'));
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
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:35',
            'body' => 'required'
        ]);

        $validatedData['category_id'] = request('category');

        $post->tags()->sync(request('tags'));
        $post->update($validatedData);

        session()->flash('success', 'Postingan berhasil diedit.');
        session()->flash('error', 'Postingan gagal diedit.');

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'Postingan berhasil dihapus.');
        session()->flash('error', 'Postingan gagal dihapus.');

        return redirect('/posts');
    }
}
