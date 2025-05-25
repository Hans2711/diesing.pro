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

        @vite([
            'resources/js/app.js',
            'resources/js/utils/zenquotes.js',
            'resources/js/gradient-scroll.js',
            'resources/js/swipe-sidebar.js',
            'resources/js/scroll-to-top.js',
            'resources/js/logo-animation.js',
            'resources/css/app.css'
        ])
        @livewireStyles
    </head>
    <body class="bg-tertiary dark:bg-secondary-dark text-black dark:text-white">
        <div
            x-data="{ sidebarOpen: false }"
            @swiperight.window="sidebarOpen = true"
            @swipeleft.window="sidebarOpen = false"
            class="flex items-start min-h-screen"
            id="app"
        >
            <button
                id="burger-menu-button"
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
            <button id="scroll-top-button" class="btn btn-secondary fixed bottom-4 right-4 md:bottom-8 md:right-8 rounded-full scroll-hidden transition-all duration-300 transform" aria-label="Scroll to top">
                <img class="w-6 h-6" src="{{ Vite::asset('resources/icons/chevron-up.svg') }}" alt="Scroll to top" />
            </button>
        </div>
        </div>

        <div class="flex h-fit">
            <div class="md:w-64 bg-white border-t border-gray-200 py-8 dark:border-gray-700 dark:text-white dark:bg-gray-900"> </div>
            <div class="flex-1">
                @include('global.footer')
            </div>
        </div>
        @livewireScripts
    </body>
</html>
