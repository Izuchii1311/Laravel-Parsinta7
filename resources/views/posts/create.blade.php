@extends('layouts.app', ['title' => 'Add New Data'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>Create new Post</h3>
                <hr>
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        Tambah Data Baru
                    </div>
                    <div class="card-body">
                        <form action="/posts/store" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Body</label>
                                <textarea type="text" class="form-control" id="body" name="body" rows="10"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
