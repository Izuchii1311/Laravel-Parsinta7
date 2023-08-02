<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        $search = request('cari');

        $posts = Post::where("title", "like", "%$search%")->latest()->paginate(6);
        return view('posts.index', compact('posts'));
    }
}
