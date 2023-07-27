@extends('layouts.app')

{{-- Title --}}
@section('title', 'About')

{{-- Style --}}
@section('head')
    <style>
        body {
            background-color: black;
            color: white
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center">About Page</h1>
    </div>
@endsection