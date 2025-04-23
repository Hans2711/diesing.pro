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
    <nav class="space-y-4 text-lg md:text-base px-2 md:px-0">
        <!-- Kontakt -->
        <div class="relative" x-data="{ open: {{ $contactOpen ? 'true' : 'false' }} }" >
            <button
                @click.stop="open = !open"
                class="w-full flex gap-1 items-center py-2 pl-2 pr-3 hover:text-black hover:bg-gray-100 rounded"
            >
                <img src="{{ Vite::asset('resources/icons/envelope.svg') }}" class="h-4 w-4 mr-3" />
                <span class="flex-grow text-left">
                    {{ __('text.contact') }}
                </span>
                <img
                    src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                    class="h-4 w-4 transition-transform duration-200"
                    :class="{ 'rotate-180': open }"
                />
            </button>
            <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('hp@diesing.pro') }}">
                        <img src="{{ Vite::asset('resources/icons/envelope.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left">
                        Hans (HP)
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/detlef.diesing@icloud.com" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('detlef.diesing@icloud.com') }}">
                        <img src="{{ Vite::asset('resources/icons/envelope.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left">
                        Detlef
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
            </ul>
        </div>

        <!-- Lebenslauf -->
        <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}"
            class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-100 rounded {{ $isActive('cv') }}">
            <img src="{{ Vite::asset('resources/icons/cv.svg') }}" class="h-4 w-4 mr-3" />
            <span class="flex-grow text-left">
                {{ __('text.cv') }}
            </span>
            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4" />
        </a>

        <!-- Random Teams -->
        <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}"
            class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-100 rounded {{ $isActive('teams') }}">
            <img src="{{ Vite::asset('resources/icons/shuffle2.svg') }}" class="h-4 w-4 mr-3" />
            <span class="flex-grow text-left">
                {{ __('text.random-teams') }}
            </span>
            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4" />
        </a>

        <!-- RT Share -->
        <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.rt-share')) }}"
            class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-100 rounded {{ $isActive('rt-share') }}">
            <img src="{{ Vite::asset('resources/icons/data-transfer.svg') }}" class="h-4 w-4 mr-3" />
            <span class="flex-grow text-left">
                {{ __('text.rt-share') }}
            </span>
            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4" />
        </a>

        <!-- Jellyfin -->
        <a href="http://www.diesing.pro:8096/" target="_blank" rel="noopener noreferrer"
            class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-100 rounded {{ $isActive('jellyfin') }}">
            <img src="{{ Vite::asset('resources/icons/play-circle.svg') }}" class="h-4 w-4 mr-3" />
            <span class="flex-grow text-left">
                Jellyfin
            </span>
            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4" />
        </a>

        <!-- Privat (Account Section) -->
        <div class="relative" x-data="{ open: {{ $accountOpen ? 'true' : 'false' }} }" >
            <button @click.stop="open = !open" class="w-full flex gap-1 items-center py-2 pl-2 pr-3 hover:text-black hover:bg-gray-100 rounded">
                <img src="{{ Vite::asset('resources/icons/user.svg') }}" class="h-4 w-4 mr-3" />
                <span class="flex-grow text-left">
                {{ __('text.account') }}
                </span>
                <img src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                     class="h-4 w-4 transition-transform duration-200"
                     :class="{ 'rotate-180': open }" />
            </button>
            <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('overview') }}">
                        <img src="{{ Vite::asset('resources/icons/user-gear.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left">
                        {{ __('text.overview') }}
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.tester')) }}" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('tester') }}">
                        <img src="{{ Vite::asset('resources/icons/quiz-alt.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left">
                        {{ __('text.tester') }}
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.notes')) }}" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('notes') }}">
                        <img src="{{ Vite::asset('resources/icons/edit.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left">
                        {{ __('text.notes') }}
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.redirects')) }}" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('redirects') }}">
                        <img src="{{ Vite::asset('resources/icons/share-square.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left truncate">
                        {{ __('text.redirects') }}
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.portfolio')) }}" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('portfolio') }}">
                        <img src="{{ Vite::asset('resources/icons/briefcase.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left">
                        {{ __('text.portfolio') }}
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
                <li>
                    <a wire:navigate href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.cv')) }}" class="w-full flex gap-1 items-center hover:bg-gray-100 p-2 rounded {{ $isToolActive('cv') }}">
                        <img src="{{ Vite::asset('resources/icons/person-cv.svg') }}" class="h-4 w-4 mr-3" />
                        <span class="flex-grow text-left">
                        {{ __('text.cv') }}
                        </span>
                        <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 " />
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
