@extends('layouts.app')

@section('title', 'Post')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <h6>{{ $post->slug }}</h6>
        <p>{{ $post->body }}</p>

        <a href="/posts" class="btn btn-primary">Kembali</a>
    </div>
@endsection