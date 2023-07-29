@extends('layouts.app', ['title' => 'Edit Data'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Edit Post</h3>
                <hr>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Edit Data Dengan Judul : {{ $post->title }}
                    </div>
                    <div class="card-body">
                        <form action="/posts/{{ $post->slug }}/edit" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" autofocus placeholder="Masukkan Judul Baru..." value="{{ old('title') ?? $post->title }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea type="text" class="form-control @error('title') is-invalid @enderror" id="body" name="body"
                                    rows="10" placeholder="Masukkan Content...">{{ old('body') ?? $post->body }}</textarea>
                                @error('body')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <a href="/posts" class="btn btn-warning text-white">Kembali</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
