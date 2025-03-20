<nav class="p-5 bg-white fixed z-30 w-full shadow">
    <div class="text-center">
        <ul class="inline-flex items-center space-x-4">
            <!-- Language Switcher -->
            <li class="relative group">
                <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
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
                <ul class="header-flyout">
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

            <!-- Menu Item 1 -->
            <li class="relative group">
                <a href="#" class="flex items-center gap-1 text-gray-700 hover:text-gray-900">
                    Hello
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="h-5 w-5 transition-transform duration-200 group-hover:rotate-180"
                    />
                </a>
                <!-- Flyout Menu -->
                <ul class="header-flyout">
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu 11</a></li>
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu 2</a></li>
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu 3</a></li>
                </ul>
            </li>

            <!-- Menu Item 2 -->
            <li class="relative group">
                <a href="#" class="flex items-center gap-1 text-gray-700 hover:text-gray-900">
                    Hell1
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="h-5 w-5 transition-transform duration-200 group-hover:rotate-180"
                    />
                </a>
                <!-- Flyout Menu -->
                <ul class="header-flyout">
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu A</a></li>
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu B</a></li>
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu C</a></li>
                </ul>
            </li>
            <li class="relative group">
                <a href="#" class="flex items-center gap-1 text-gray-700 hover:text-gray-900">
                    Hell1
                    <img
                        src="{{ Vite::asset('resources/icons/chevron-down.svg') }}"
                        alt="Chevron"
                        class="h-5 w-5 transition-transform duration-200 group-hover:rotate-180"
                    />
                </a>
                <!-- Flyout Menu -->
                <ul class="header-flyout">
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu A</a></li>
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu B</a></li>
                    <li><a href="#" class="block py-2 hover:bg-gray-100">Submenu C</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
