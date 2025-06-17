@php
$otherlang = Config::get('app.locale') == 'de' ? 'en' : 'de';
$otherUrl = App\Utilities\LanguageUtility::getOtherLangUrl();

$isActive = fn($key) => $active === $key ? 'bg-gray-300 text-black dark:text-white dark:bg-gray-700' : '';
$isToolActive = fn($tool) => $activeTool === $tool ? 'bg-gray-300 text-black dark:text-white dark:bg-gray-700' : '';
$isContactActive = fn($email) => $activeTool === $email ? 'bg-gray-300 text-black dark:text-white dark:bg-gray-700' : '';
$accountOpen = in_array($activeTool ?? '', ['overview', 'tester', 'notes', 'redirects', 'portfolio', 'cv', 'timetracking', 'rss-feeds']);
$contactOpen = in_array($activeTool ?? '', ['hp@diesing.pro', 'detlef.diesing@icloud.com']);


@endphp



<aside
    :class="{
    'translate-x-0': sidebarOpen,
    '-translate-x-full': !sidebarOpen
    }"
    class="self-start
    fixed md:sticky
    top-0 left-0
    w-full md:w-64
    h-screen
    md:transform-none
    transition-transform duration-300 ease-in-out
    z-40 md:z-auto
    bg-tertiary dark:bg-gray-900 text-black dark:text-white
    shadow-lg
    overflow-y-auto"
    @click.away="sidebarOpen = false"
>
    <div class="flex flex-col min-h-screen">
        <div class="flex items-center gap-5 mb-6 justify-between md:justify-around p-2 px-4 md:px-0 mt-4">
            <a alt="{{ __('titles.home') }}" title="{{ __('titles.home') }}" wire:navigate.hover href="/{{ App::getLocale() }}" class="pl-2">

                @include('global.logo', [])
            </a>
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button @click.stop="open = !open" class="flex items-center gap-1 text-gray-700 hover:text-black dark:text-white dark:hover:text-gray-100 ">
                    <img src="{{ Vite::asset('resources/icons/' . __('language.svg') . '.svg') }}" class="h-5 w-5" alt="{{ __('language.name') }}" title="{{ __('language.name') }}" />
                    {{ __('language.name') }}
                    <img src="{{ Vite::asset('resources/icons/chevron-down.svg') }}" class="h-4 w-4 transition-transform duration-200 dark:invert" :class="{ 'rotate-180': open }" alt="Toggle" title="Toggle" />
                </button>
                <ul x-show="open" x-transition class="absolute -right-5 md:right-0 mt-2 w-40 bg-white dark:bg-secondary-dark shadow-lg rounded z-50">
                    <li>
                        <a alt="{{ __('language.name-' . $otherlang) }}" title="{{ __('language.name-' . $otherlang) }}" wire:navigate.hover href="{{ $otherUrl }}" class="flex items-center justify-between gap-2 px-4 py-2 hover:bg-gray-300 dark:hover:bg-gray-700 dark:hover:text-white rounded">
                            <img src="{{ Vite::asset('resources/icons/' . __('language.svg-' . $otherlang) . '.svg') }}" class="h-5 w-5" alt="{{ __('language.name-' . $otherlang) }}" title="{{ __('language.name-' . $otherlang) }}" />
                            {{ __('language.name-' . $otherlang) }}
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 text-gray-400 dark:invert" alt="Forward" title="Forward" />
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
                <img
                    x-show="sidebarOpen"
                    src="{{ Vite::asset('resources/icons/close.svg') }}"
                    class="h-8 w-8 dark:invert"
                    alt="{{ __('alt.close_menu') }}"
                    title="{{ __('alt.close_menu') }}"
                />
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto space-y-4 text-lg md:text-base px-4 pb-8">
            <!-- Kontakt -->
            <div class="relative" x-data="{ open: {{ $contactOpen ? 'true' : 'false' }} }" >
                <button
                    @click.stop="open = !open"
                    class="w-full flex gap-1 items-center py-2 pl-2 pr-3 hover:text-black hover:bg-gray-300 dark:hover:bg-gray-700 dark:hover:text-white rounded"
                >
                    <img src="{{ Vite::asset('resources/icons/envelope.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt="{{ __('alt.send') }}" title="{{ __('alt.send') }}" />
                    <span class="flex-grow text-left">
                        {{ __('text.contact') }}
                    </span>
                    <img src="{{ Vite::asset('resources/icons/chevron-down.svg') }}" class="h-4 w-4 transition-transform duration-200 dark:invert" :class="{ 'rotate-180': open }" alt="" />
                </button>
                <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                    <li>
                        <a wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 dark:hover:bg-gray-700 dark:hover:text-white rounded {{ $isToolActive('hp@diesing.pro') }}">
                            <img src="{{ Vite::asset('resources/icons/envelope.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt="{{ __('alt.send') }}" title="{{ __('alt.send') }}" />
                            <span class="flex-grow text-left">
                                Hans (HP)
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="Forward" title="Forward" />
                        </a>
                    </li>
                    <li>
                        <a wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/detlef.diesing@icloud.com" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 dark:hover:bg-gray-700 dark:hover:text-white rounded {{ $isToolActive('detlef.diesing@icloud.com') }}">
                            <img src="{{ Vite::asset('resources/icons/envelope.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt="{{ __('alt.send') }}" title="{{ __('alt.send') }}" />
                            <span class="flex-grow text-left">
                                Detlef
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="Forward" title="Forward" />
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Lebenslauf -->
            <a alt="{{ __('text.cv') }}" title="{{ __('text.cv') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}"
                class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-300 rounded dark:hover:bg-gray-700 dark:hover:text-white {{ $isActive('cv') }}">
                <img src="{{ Vite::asset('resources/icons/cv.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.cv') }}' />
                <span class="flex-grow text-left">
                    {{ __('text.cv') }}
                </span>
                <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
            </a>

            <!-- Random Teams -->
            <a alt="{{ __('text.random-teams') }}" title="{{ __('text.random-teams') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}"
                class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-300 rounded  dark:hover:bg-gray-700 dark:hover:text-white {{ $isActive('teams') }}">
                <img src="{{ Vite::asset('resources/icons/shuffle2.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.random-teams') }}' />
                <span class="flex-grow text-left">
                    {{ __('text.random-teams') }}
                </span>
                <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
            </a>

            <!-- RT Share -->
            <a alt="{{ __('text.rt-share') }}" title="{{ __('text.rt-share') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.rt-share')) }}"
                class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-300 rounded dark:hover:bg-gray-700 dark:hover:text-white {{ $isActive('rt-share') }}">
                <img src="{{ Vite::asset('resources/icons/data-transfer.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.rt-share') }}' />
                <span class="flex-grow text-left">
                    {{ __('text.rt-share') }}
                </span>
                <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
            </a>

            <!-- Jellyfin -->
            <a alt="Jellyfin" title="Jellyfin" href="http://139.162.132.136:8096/" target="_blank" rel="noopener noreferrer"
                class="w-full flex items-center gap-1 py-2 pl-2 pr-3 hover:text-black hover:bg-gray-300 rounded  dark:hover:bg-gray-700 dark:hover:text-white {{ $isActive('jellyfin') }}">
                <img src="{{ Vite::asset('resources/icons/play-circle.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='Jellyfin' />
                <span class="flex-grow text-left">
                    Jellyfin
                </span>
                <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
            </a>

            <!-- Privat (Account Section) -->
            <div class="relative" x-data="{ open: {{ $accountOpen ? 'true' : 'false' }} }" >
                <button @click.stop="open = !open" class="w-full flex gap-1 items-center py-2 pl-2 pr-3 hover:text-black hover:bg-gray-300 rounded  dark:hover:bg-gray-700 dark:hover:text-white">
                    <img src="{{ Vite::asset('resources/icons/user.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.account') }}' />
                    <span class="flex-grow text-left">
                        {{ __('text.account') }}
                    </span>
                    <img src="{{ Vite::asset('resources/icons/chevron-down.svg') }}" class="h-4 w-4 transition-transform duration-200 dark:invert" :class="{ 'rotate-180': open }"  alt="" />
                </button>
                <ul x-show="open" x-transition class="pl-4 mt-2 space-y-1">
                    <li>
                        <a alt="{{ __('text.overview') }}" title="{{ __('text.overview') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded  dark:hover:bg-gray-700 dark:hover:text-white {{ $isToolActive('overview') }}">
                            <img src="{{ Vite::asset('resources/icons/user-gear.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.overview') }}' />
                            <span class="flex-grow text-left">
                                {{ __('text.overview') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                    <li>
                        <a alt="{{ __('text.tester') }}" title="{{ __('text.tester') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.tester')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded  dark:hover:bg-gray-700 dark:hover:text-white {{ $isToolActive('tester') }}">
                            <img src="{{ Vite::asset('resources/icons/quiz-alt.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.tester') }}' />
                            <span class="flex-grow text-left">
                                {{ __('text.tester') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                    <li>
                        <a alt="{{ __('text.notes') }}" title="{{ __('text.notes') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.notes')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded  dark:hover:bg-gray-700 dark:hover:text-white {{ $isToolActive('notes') }}">
                            <img src="{{ Vite::asset('resources/icons/edit.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.notes') }}' />
                            <span class="flex-grow text-left">
                                {{ __('text.notes') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                    <li>
                        <a alt="{{ __('text.redirects') }}" title="{{ __('text.redirects') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.redirects')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded  dark:hover:bg-gray-700 dark:hover:text-white {{ $isToolActive('redirects') }}">
                            <img src="{{ Vite::asset('resources/icons/share-square.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.redirects') }}' />
                            <span class="flex-grow text-left truncate">
                                {{ __('text.redirects') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                    <li>
                        <a alt="{{ __('text.portfolio') }}" title="{{ __('text.portfolio') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.portfolio')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded   dark:hover:bg-gray-700 dark:hover:text-white{{ $isToolActive('portfolio') }}">
                            <img src="{{ Vite::asset('resources/icons/briefcase.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.portfolio') }}' />
                            <span class="flex-grow text-left">
                                {{ __('text.portfolio') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                    <li>
                        <a alt="{{ __('text.cv') }}" title="{{ __('text.cv') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.cv')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded dark:hover:bg-gray-700 dark:hover:text-white {{ $isToolActive('cv') }}">
                            <img src="{{ Vite::asset('resources/icons/person-cv.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.cv') }}' />
                            <span class="flex-grow text-left">
                                {{ __('text.cv') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                    <li>
                        <a alt="{{ __('text.timetracking') }}" title="{{ __('text.timetracking') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.timetracking')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded dark:hover:bg-gray-700 dark:hover:text-white {{ $isToolActive('timetracking') }}">
                            <img src="{{ Vite::asset('resources/icons/time.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt='{{ __('text.timetracking') }}' />
                            <span class="flex-grow text-left">
                                {{ __('text.timetracking') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                    <li>
                        <a alt="{{ __('text.rss-feeds') }}" title="{{ __('text.rss-feeds') }}" wire:navigate.hover href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.rss-feeds')) }}" class="w-full flex gap-1 items-center hover:bg-gray-300 p-2 rounded dark:hover:bg-gray-700 dark:hover:text-white {{ $isToolActive('rss-feeds') }}">
                            <img src="{{ Vite::asset('resources/icons/rss.svg') }}" class="h-4 w-4 mr-3 dark:invert" alt="{{ __('alt.rss') }}" title="{{ __('alt.rss') }}" />
                            <span class="flex-grow text-left">
                                {{ __('text.rss-feeds') }}
                            </span>
                            <img src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}" class="h-4 w-4 dark:invert" alt="" />
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</aside>


