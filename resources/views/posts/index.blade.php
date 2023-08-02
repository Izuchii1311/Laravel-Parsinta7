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
                @if (Auth::check())
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add New Post +</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login to create a new Post</a>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">

                @forelse ($posts as $post)
                    <div class="card my-3">
                        @if ($post->thumbnail)
                            <a href="{{ route('posts.show', $post->slug) }}">
                                <img src="{{ $post->take_image }}" class="card-img-top"
                                    style="height: 300px; object-fit:cover;">
                            </a>
                        @endif

                        <div class="card-body">
                            <a href="{{ route('categories.show', $post->category->slug) }}"
                                class="text-secondary text-decoration-none">
                                <small>{{ $post->category->name }}</small>
                            </a>
                            -
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('tags.show', $tag->slug) }}" class="text-secondary text-decoration-none">
                                    <small>{{ $tag->name }}</small>
                                </a>
                            @endforeach

                            <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-primary">
                                <h5>
                                    <div class="text-black">{{ $post->title }}</div>
                                </h5>
                            </a>
                            <div>
                                {{ Str::limit($post->body, 130, '.') }}
                            </div>
                            <a href="/posts/{{ $post->slug }}">Read more...</a>
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="media my-3">
                                    <img src="{{ $post->author->gravatar() }}" alt="" width="40"
                                        class="rounded-circle mr-3">
                                    <div class="media-body">
                                        {{ $post->author->name }}
                                    </div>
                                </div>
                                <div class="text-secondary mt-2">
                                    <small>
                                        Published on {{ $post->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            Published on {{ $post->created_at->diffForHumans() }}
                            @can('update', $post)
                                <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-warning text-white">Edit
                                    Data</a>
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="col-md-6">
                        <div class="alert alert-info">There's no posts.</div>
                    </div>
                @endforelse
            </div>
        </div>
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
@endsection
