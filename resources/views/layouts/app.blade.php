<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <title>
    @if (isset($title))
        {{ $title }} - Diesing
    @else
        {{ config('app.name', 'Diesing') }}</title>
    @endif
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @livewireScripts
</head>
<body>
    <div id="app">
        @include('global.header', ['active' => $active ?? null])
        <div class="container mx-auto md:px-0 px-6 pt-20">
            @yield('content')
        </div>
    </div>

    @include('global.footer')
</body>
</html>
