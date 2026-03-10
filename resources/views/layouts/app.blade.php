<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title','Travel')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('styles')
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>

<body class="min-h-screen flex flex-col bg-black-900 text-white">

@include('partials.header')

<main class="flex-1 mt-18">
    @yield('content')
</main>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@stack('scripts')

</body>
</html>
