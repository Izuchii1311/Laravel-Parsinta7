@extends('layouts.app')

@section('title', 'Post Index')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                @isset($category)
                    <h4>Category : {{ $category->name }}</h4>
                @endisset

                @isset($tag)
                    <h4>Tag : {{ $tag->name }}</h4>
                @endisset

                @if (!isset($tag) && !isset($category))
                    <h4>All Posts</h4>
                @endif
                <hr>
            </div>
            <div>
                {{-- @can() --}}
                @if (Auth::check())
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add New Post +</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login to create a new Post</a>
                @endif
                {{-- @endcan --}}
            </div>

        </div>
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4">
                    <div class="card my-3">
                        {{-- <img src="{{ asset("storage/" . $post->thumbnail) }}" class="card-img-top" alt=""> --}}
                        @if($post->thumbnail)
                            <img src="{{ $post->take_image }}" class="card-img-top" style="height: 300px; object-fit:cover;">
                        @endif
                        <div class="card-body">
                            <div class="card-title">{{ $post->title }}</div>
                            <div>
                                {{ Str::limit($post->body, 100, '.') }}
                            </div>
                            <a href="/posts/{{ $post->slug }}">Read more...</a>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Published on {{ $post->created_at->diffForHumans() }}
                            @can('update', $post)
                                <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-warning text-white">Edit Data</a>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-6">
                    <div class="alert alert-info">There's no posts.</div>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
