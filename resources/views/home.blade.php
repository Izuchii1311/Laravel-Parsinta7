@extends('layouts.app')

{{-- Title --}}
@section('title', 'Home')

@section('content')
    <div class="container">
        <h1 class="text-center">Home Page</h1>
        Hello My Name {{ $name }}
    </div>
@endsection