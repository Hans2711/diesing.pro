@php
    $otherlang = Config::get('app.locale') == 'de' ? 'en' : 'de';

    $isActive = fn($key) => $active === $key ? 'bg-gray-200 text-black' : '';
    $isToolActive = fn($tool) => $activeTool === $tool ? 'bg-gray-100 text-black' : '';
    $isContactActive = fn($email) => $activeTool === $email ? 'bg-gray-100 text-black' : '';
    $accountOpen = in_array($activeTool ?? '', ['overview', 'tester', 'notes', 'redirects', 'portfolio', 'cv']);
    $contactOpen = in_array($activeTool ?? '', ['hp@diesing.pro', 'detlef.diesing@icloud.com']);
@endphp

<aside
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
    class="fixed z-40 md:sticky md:top-0 md:h-screen md:translate-x-0 transform top-0 left-0 w-full md:w-64 overflow-y-auto bg-white shadow-lg p-5 text-gray-800 transition-transform duration-300 ease-in-out"
    @click.away="sidebarOpen = false"
>
    <!-- Logo + Language -->
    <div class="flex items-center gap-5 mb-6 justify-between md:justify-start p-2">
        <a wire:navigate href="/">
            <img src="{{ Vite::asset('resources/logo/DLogo.png') }}" class="h-10" alt="Logo" />
        </a>
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click.stop="open = !open" class="flex items-center gap-1 text-gray-700 hover:text-black">
                <img src="{{ Vite::asset('resources/icons/' . __('language.svg') . '.svg') }}" class="h-5 w-5" />
                {{ __('language.name') }}
                <img src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-180': open }" />
            </button>
            <ul x-show="open" x-transition class="absolute -left-5 mt-2 w-40 bg-white shadow-lg rounded z-50">
                <li>
                    <a wire:navigate href="{{ url('/' . $otherlang) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                        <img src="{{ Vite::asset('resources/icons/' . __('language.svg-' . $otherlang) . '.svg') }}" class="h-5 w-5" />
                        {{ __('language.name-' . $otherlang) }}
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 text-gray-400" />
                    </a>
                </li>
            </ul>
        </div>
        <button
            @click.stop="sidebarOpen = !sidebarOpen"
            class="md:hidden"
            aria-label="Toggle menu"
        >
            <!-- Menu Icon -->
            <img x-show="sidebarOpen" src="{{ Vite::asset('resources/icons/close.svg') }}" class="h-8 w-8" alt="Close Menu" />
        </button>
    </div>

    <!-- Navigation -->
    <nav class="space-y-4">
        <!-- Kontakt -->
        <div class="relative" x-data="{ open: {{ $contactOpen ? 'true' : 'false' }} }" >
            <button @click.stop="open = !open" class="w-full flex justify-between items-center py-2 hover:text-black hover:bg-gray-100 rounded p-2">
                {{ __('text.contact') }}
                <img src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-180': open }" />
            </button>
            <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                <li><a href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('hp@diesing.pro') }}">Hans (HP)</a></li>
                <li><a href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/detlef.diesing@icloud.com" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('detlef.diesing@icloud.com') }}">Detlef</a></li>
            </ul>
        </div>

        <!-- Lebenslauf -->
        <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}"
           class="block py-2 rounded p-2 hover:text-black hover:bg-gray-100 {{ $isActive('cv') }}">
            {{ __('text.cv') }}
        </a>

        <!-- Random Teams -->
        <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}"
           class="block py-2 rounded p-2 hover:text-black hover:bg-gray-100 {{ $isActive('random-teams') }}">
            {{ __('text.random-teams') }}
        </a>

        <!-- Jellyfin -->
        <a href="http://www.diesing.pro:8096/"
           class="block py-2 rounded p-2 hover:text-black hover:bg-gray-100 {{ $isActive('jellyfin') }}">
            Jellyfin
        </a>

        <!-- Privat (Account Section) -->
        <div class="relative" x-data="{ open: {{ $accountOpen ? 'true' : 'false' }} }" >
            <button @click.stop="open = !open" class="w-full flex justify-between items-center py-2 hover:text-black hover:bg-gray-100 rounded p-2">
                {{ __('text.account') }}
                <img src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                     class="h-4 w-4 transition-transform duration-200"
                     :class="{ 'rotate-180': open }" />
            </button>
            <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                <li><a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('overview') }}">{{ __('text.overview') }}</a></li>
                <li><a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.tester')) }}" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('tester') }}">{{ __('text.tester') }}</a></li>
                <li><a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.notes')) }}" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('notes') }}">{{ __('text.notes') }}</a></li>
                <li><a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.redirects')) }}" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('redirects') }}">{{ __('text.redirects') }}</a></li>
                <li><a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.portfolio')) }}" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('portfolio') }}">{{ __('text.portfolio') }}</a></li>
                <li><a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.cv')) }}" class="block hover:bg-gray-100 p-2 rounded {{ $isToolActive('cv') }}">{{ __('text.cv') }}</a></li>
            </ul>
        </div>
    </nav>
</aside>
