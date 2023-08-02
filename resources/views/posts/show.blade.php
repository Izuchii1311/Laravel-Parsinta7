    @extends('layouts.app')

    @section('title', 'Post')

    @section('content')
        <div class="container">
            <h1>{{ $post->title }}</h1>
            <div class="text-secondary"><a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
                &middot; {{ $post->created_at->format('d F, Y') }}
                &middot;
                @foreach ($post->tags as $tag)
                    <a href="/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
                @endforeach

                <div class="media">
                    <img src="{{ $post->author->gravatar() }}" alt="" width="60" class="rounded-circle mr-3">
                    <div class="media-body">
                        <div>
                            {{ $post->author->name }}
                        </div>
                        {{ '@' . $post->author->username }}
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8">
                    @if ($post->thumbnail)
                        <img src="{{ $post->take_image }}" alt="" style="height: 300px; object-fit:cover; object-position:center;">
                    @endif
                    <p>{!! nl2br($post->body) !!}</p>

                    <a href="/posts" class="btn btn-primary me-2">Kembali</a>

                    {{-- jika usernya adalah dia maka hanya dia yang bisa menghapus postingannya. --}}
                    @can('delete', $post)
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Delete
                        </button>
                    @endcan

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ingin menghapus Data?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/posts/{{ $post->slug }}/delete" method="post">
                                        @csrf
                                        @method('delete')
                                        <p>Data ini akan dihapus secara permanen. Apakah Anda yakin ingin menghapus datanya?
                                        </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @foreach ($posts as $post)
                        <div>
                            <div class="card my-3">
                                {{-- @if ($post->thumbnail)
                                    <a href="{{ route('posts.show', $post->slug) }}">
                                        <img src="{{ $post->take_image }}" class="card-img-top"
                                            style="height: 300px; object-fit:cover;">
                                    </a>
                                @endif --}}
        
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
                                        {{-- <div class="text-secondary mt-2">
                                            <small>
                                                Published on {{ $post->created_at->diffForHumans() }}
                                            </small>
                                        </div> --}}
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
