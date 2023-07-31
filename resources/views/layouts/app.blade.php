<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>@yield('title')</title> --}}
    <title>{{ $title ?? 'Laravel Project' }}</title>

    {{-- bootstrap --}}
    <link rel="stylesheet" href="/css/bootstrap.css">
    {{-- select2.org  --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('head')
</head>

<body>
    @include('layouts.navigation')

    <div class="py-4">
        @include('alert')
        @yield('content')
    </div>

    @yield('script')

    {{-- bootstrap --}}
    <script src="/js/bootstrap.js"></script>
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    {{-- select2.org --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Pilih Tag untuk post anda!"
            });
        });
    </script>
</body>

</html>
