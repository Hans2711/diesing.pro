<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('global.head.font-preload')
        @include('global.head.title', ['title' => $title ?? null])
        @include('global.head.og-tags', ['title' => $title ?? null, 'description' => $description ?? null, 'keywords' => $keywords ?? null])
        <style>
        {!! Vite::content('resources/css/app.css') !!}
        </style>
    </head>
    <body @if(isset($print)) onload="window.print()" @endif>
        <div id="app">
            <div class="container mx-auto md:px-0 px-6 pt-5">
                @yield('content')
            </div>
        </div>

        @vite(['resources/js/app.js'])
        @include('global.head.google-analytics', ['title' => $title ?? null])
    </body>
</html>
