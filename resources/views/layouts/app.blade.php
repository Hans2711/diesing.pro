<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    @include('global.head.viewport')
    @include('global.head.translations')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('global.head.font-preload')
    @include('global.head.title', ['title' => $title ?? null])
    @include('global.head.og-tags', ['title' => $title ?? null, 'description' => $description ?? null])
    @include('global.head.google-analytics', ['title' => $title ?? null])

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @include('global.header', ['active' => $active ?? null])
        <div class="container mx-auto md:px-0 px-6 pt-32 sm:pt-20">
            @yield('content')
        </div>
    </div>

    @include('global.footer')
</body>
</html>
