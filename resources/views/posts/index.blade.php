@extends('layouts.app')

@section('title', 'Post Index')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h3>All Post</h3>
                <hr>
            </div>
            <div>
                <a href="/posts/create" class="btn btn-primary">Add New Post +</a>
            </div>
        </div>
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-md-4">
                    <div class="card my-3">
                        <div class="card-header">{{ $post->title }}</div>
                        <div class="card-body">
                            <div>
                                {{ Str::limit($post->body, 100, '.') }}
                            </div>
                            <a href="/posts/{{ $post->slug }}">Read more...</a>
                        </div>
                        <div class="card-footer">
                            Published on {{ $post->created_at->diffForHumans() }}
                            {{ $post->created_at->format('d F, Y') }}
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
