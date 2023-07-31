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
            </div>
            <hr>
            <p>{{ $post->body }}</p>

            <a href="/posts" class="btn btn-primary me-2">Kembali</a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Delete
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ingin menghapus Data?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @auth
                            <div class="modal-body">
                                <form action="/posts/{{ $post->slug }}/delete" method="post">
                                    @csrf
                                    @method('delete')
                                    <p>Data ini akan dihapus secara permanen. Apakah Anda yakin ingin menghapus datanya?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>

        </div>
    @endsection
