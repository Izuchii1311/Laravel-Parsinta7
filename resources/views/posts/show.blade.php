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
            <div class="text-secondary">
                Pembuat {{ $post->author->name }}
            </div>
            <hr>
            <p>{{ $post->body }}</p>

            <a href="/posts" class="btn btn-primary me-2">Kembali</a>

            {{-- jika usernya adalah dia maka hanya dia yang bisa menghapus postingannya. --}}
            @can('delete', $post)
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Delete
                </button>
            @endcan

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ingin menghapus Data?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
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
                    </div>
                </div>
            </div>

        </div>
    @endsection
