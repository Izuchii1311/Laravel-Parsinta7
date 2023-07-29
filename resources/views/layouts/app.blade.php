<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>@yield('title')</title> --}}
    <title>{{ $title ?? 'Laravel Project' }}</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    @yield('head')
</head>

<body>
    @include('layouts.navigation')

    <div class="py-4">
        @include('alert')
        @yield('content')
    </div>

    @yield('script')

    <script src="/js/bootstrap.js"></script>
</body>
</html>