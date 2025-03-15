<nav class="p-5 bg-white fixed z-30 w-full shadow md:flex md:items-center md:justify-between">
    <div class="flex justify-between items-center">
        <span class="text-2xl font-[Poppins] cursor-pointer">
            <a wire:navigate.hover href="{{ url('/' . Config::get('app.locale')) }}">
                <img class="h-10 inline" src="{{ Vite::asset('resources/logo/DLogo.png') }}">
            </a>
        </span>
        <div class="flex items-center z-50">
            <div class="relative group inline-block text-left ml-4">
                <button
                    type="button"
                    class="inline-flex items-center justify-between w-40 rounded-md border border-gray-300 px-4 py-2 bg-white text-sm font-medium "
                    id="language-button"
                    onclick="window.triggerLanguageDropdown(this)"
                >
                    <img
                        src="{{ Vite::asset('resources/icons/' . __('language.svg') . '.svg') }}"
                        alt="{{ __('language.name') }}"
                        class="h-5 w-5 mr-2"
                        loading="eager"
                    />
                    {{ __('language.name') }}
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="ml-2 h-5 w-5 text-gray-400"
                    />
                </button>
                @php
                $otherlang = Config::get('app.locale') == 'de' ? 'en' : 'de';
                @endphp
                <div
                    id="language-dropdown"
                    class="origin-top-right absolute left-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden"
                >
                    <div class=" inline-flex justify-between w-full text-sm font-medium">
                        <a
                            href="{{ url('/' . $otherlang) }}"
                            class="flex justify-between items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 btn-language"
                        >
                            <img
                                src="{{ Vite::asset('resources/icons/' . __('language.svg-' . $otherlang) . '.svg') }}"
                                alt="{{ __('language.name-' . $otherlang) }}"
                                class="h-5 w-5 mr-2"
                            />
                            {{ __('language.name-' . $otherlang) }}
                            <img
                                src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}"
                                alt="Chevron"
                                class="ml-2 h-5 w-5 text-gray-400"
                            />
                        </a>
                    </div>
                </div>
            </div>
            <span class="text-3xl z-50 cursor-pointer mx-2 md:hidden block">
                <img class="h-9 w-9" id="menu-img" src="{{ Vite::asset('resources/icons/menu.svg') }}">
            </span>
        </div>
    </div>
    <ul id="header-list"
        class="md:flex md:items-center z-40 md:z-auto md:static absolute bg-white w-full left-0 md:w-auto
        md:py-0 md:pl-0 pl-3 md:opacity-100 opacity-0 top-[-400px]
        transition-all ease-in duration-500">
        <li class="mx-2 my-6 md:my-0">
            <a wire:navigate.hover
                class="@if ($active == 'portfolio') active @endif header-button"
                href="{{ url(Config::get('app.locale') . '/' . __('url.portfolio')) }}">
                {{ __('text.portfolio') }}
            </a>
        </li>
        <li class="mx-2 my-6 md:my-0">
            <a wire:navigate.hover
                class="@if ($active == 'contact') active @endif header-button"
                href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}">
                {{ __('text.contact') }}
            </a>
        </li>
        <li class="mx-2 my-6 md:my-0 md:hidden lg:block">
            <a wire:navigate.hover
                class="@if ($active == 'tester') active @endif header-button"
                href="{{ url(Config::get('app.locale') . '/' . __('url.tester')) }}">
                {{ __('text.tester') }}
            </a>
        </li>
        <li class="mx-2 my-6 md:my-0">
            <a wire:navigate.hover
                class="@if ($active == 'teams') active @endif header-button"
                href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}">
                {{ __('text.random-teams') }}
            </a>
        </li>
        <li class="mx-2 my-6 md:my-0 sm:hidden md:block">
            <a
                class="header-button"
                href="http://www.diesing.pro:8096/">Jellyfin</a>
        </li>
        <li class="mx-2 my-6 md:my-0">
            <a
                class="@if ($active == 'account') active @endif header-button"
                href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}">
                {{ __('text.account') }}
            </a>
        </li>
    </ul>
</nav>

<div class="hidden top-[80px] opacity-100"></div>
