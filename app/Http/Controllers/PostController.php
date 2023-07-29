<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
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
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:35',
            'body' => 'required'
        ]);

        $validatedData['slug'] = Str::slug($request->title);

        Post::create($validatedData);

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
        return view('posts.edit', compact('post'));
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
        $post->delete();

        session()->flash('success', 'Postingan berhasil dihapus.');
        session()->flash('error', 'Postingan gagal dihapus.');

        return redirect('/posts');
    }
}
