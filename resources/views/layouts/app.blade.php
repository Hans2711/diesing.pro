<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
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

        @vite(['resources/js/app.js'])

        <style>
            {!! Vite::content('resources/css/app.css') !!}
        </style>
    </head>
    <body class="bg-tertiary dark:bg-secondary-dark text-black dark:text-white">
        <div x-data="{ sidebarOpen: false }" class="flex min-h-screen" id="app">
            <button
                @click.stop="sidebarOpen = !sidebarOpen"
                class="md:hidden p-4 z-50 fixed top-0 left-0 dark:invert"
                aria-label="Toggle menu"
            >
                <!-- Menu Icon -->
                <img x-show="!sidebarOpen" src="{{ Vite::asset('resources/icons/menu.svg') }}" class="h-8 w-8" alt="Open Menu" />
            </button>

            @include('global.header', ['active' => $active ?? null, 'activeTool' => $activeTool ?? null])
            <div
                x-show="sidebarOpen"
                class="fixed inset-0 bg-black bg-opacity-30 md:hidden z-30"
                @click="sidebarOpen = false"
                x-transition.opacity
            ></div>
            <main class="flex-1 p-4 pt-16 md:pt-4">
                @yield('content')
            </main>
        </div>
        </div>

        @include('global.footer')
    </body>
</html>
