<nav class="p-5 bg-white fixed z-30 w-full shadow">
    <div class="flex flex-col sm:flex-row justify-center items-center text-center">
        <ul class="inline-flex items-center space-x-4 mb-5 sm:mb-0">
            <li class="relative group ">
            <a wire:navigate.hover href="{{ url('/' . Config::get('app.locale')) }}">
                <img class="h-10 inline" src="{{ Vite::asset('resources/logo/DLogo.png') }}">
            </a>
            </li>
            <li class="relative group ">
                <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-gray-900 sm:px-4">
                    <img
                        src="{{ Vite::asset('resources/icons/' . __('language.svg') . '.svg') }}"
                        alt="{{ __('language.name') }}"
                        class="h-5 w-5"
                        loading="eager"
                    />
                    {{ __('language.name') }}
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="h-4 w-4 transition-transform duration-200 group-hover:rotate-180"
                    />
                </a>
                @php
                $otherlang = Config::get('app.locale') == 'de' ? 'en' : 'de';
                @endphp
                <!-- Flyout Menu -->
                <ul class="header-flyout lang-flyout z-50">
                    <li>
                        <a
                            href="{{ url('/' . $otherlang) }}"
                            class="flex items-center justify-center gap-2 px-4 py-2 text-gray-700 hover:bg-gray-100"
                        >
                            <img
                                src="{{ Vite::asset('resources/icons/' . __('language.svg-' . $otherlang) . '.svg') }}"
                                alt="{{ __('language.name-' . $otherlang) }}"
                                class="h-5 w-5"
                            />
                            {{ __('language.name-' . $otherlang) }}

                            <img
                                src="{{ Vite::asset('resources/icons/chevron-forward.svg') }}"
                                alt="Chevron"
                                class="h-4 w-4 text-gray-400"
                            />

                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="inline-flex items-center space-x-4">
            <!-- Menu Item 1 -->
            <li class="relative group">
                <a href="#" class="flex items-center gap-1 text-gray-700 hover:text-gray-900">
                    {{ __('text.contact') }}
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="h-5 w-5 transition-transform duration-200 group-hover:rotate-180"
                    />
                </a>
                <!-- Flyout Menu -->
                <ul class="header-flyout">
                    <li><a href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/hp@diesing.pro" class="block py-2 hover:bg-gray-100">Hans (HP)</a></li>
                    <li><a href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}/detlef.diesing@icloud.com" class="block py-2 hover:bg-gray-100">Detlef</a></li>
                </ul>
            </li>

            <!-- Menu Item 2 -->
            <li class="relative group">
                <a href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}" class="flex items-center gap-1 text-gray-700 hover:text-gray-900">
                    {{ __('text.cv') }}
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="h-5 w-5 transition-transform duration-200 -rotate-90"
                    />
                </a>
            </li>
            <li class="relative group">
                <a href="#" class="flex items-center gap-1 text-gray-700 hover:text-gray-900">
                    {{ __('text.private') }}
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="h-5 w-5 transition-transform duration-200 group-hover:rotate-180"
                    />
                </a>
                <!-- Flyout Menu -->
                <ul class="header-flyout">
                    <li><a href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}" class="block py-2 hover:bg-gray-100">{{ __('text.account') }}</a></li>
                    <li><a href="http://www.diesing.pro:8096/" class="block py-2 hover:bg-gray-100">Jellyfin</a></li>
                    <li><a href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}" class="block py-2 hover:bg-gray-100">{{ __('text.random-teams') }}</a></li>
                    <li><a href="{{ url(Config::get('app.locale') . '/' . __('url.tester')) }}" class="block py-2 hover:bg-gray-100">{{ __('text.tester') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
