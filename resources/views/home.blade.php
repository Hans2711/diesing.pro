@extends('layouts.app', ['title' => __('titles.home'), 'description' => __('descriptions.home'), 'dark' => false])

@section('content')
    <h1>{{ __('text.welcome') }}</h1>

    <div class="md:columns-2 columns-1 md:mb-8 mb-0" id="portfolio">
        <!-- Card: Contact -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-left">
            <a alt="{{ __('text.contact') }}" title="{{ __('text.contact') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/kontakt.jpg') }}" alt="{{ __('text.contact') }}" title="{{ __('text.contact') }}">
                </div>
                <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.contact') }}
                    </div>
                    <div class="mb-2">
                        {{ __('text.contact-description') }}
                    </div>
                </div>
            </a>
        </div>

        <!-- Card: Portfolio -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-right">
            <a alt="{{ __('text.cv') }}" title="{{ __('text.cv') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/portfolio.jpg') }}" alt="{{ __('text.cv') }}" title="{{ __('text.cv') }}">
                </div>
                <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.cv') }}
                    </div>
                    <div class="mb-2">
                        {{ __('text.cv-description') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="md:columns-2 columns-1 md:mb-8 md-0" id="portfolio">
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-left">
            <a alt="{{ __('text.random-teams') }}" title="{{ __('text.random-teams') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/random.jpg') }}" alt="{{ __('text.random-teams') }}" title="{{ __('text.random-teams') }}">
                </div>
                <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.random-teams') }}
                    </div>
                    <div class="mb-2">
                        {{ __('text.random-teams-description') }}
                    </div>
                </div>
            </a>
        </div>
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-right">
            <a alt="{{ __('text.rt-share') }}" title="{{ __('text.rt-share') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.rt-share')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/private.jpg') }}" alt="{{ __('text.rt-share') }}" title="{{ __('text.rt-share') }}">
                </div>
                <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.rt-share') }}
                    </div>
                    <div class="mb-2">
                        {!! __('descriptions.rt-share') !!}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="md:columns-1 columns-1 md:mb-8 md-0" id="portfolio">
        <!-- Card: Account -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0">
            <a alt="{{ __('text.account') }}" title="{{ __('text.account') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/private.jpg') }}" alt="{{ __('text.account') }}" title="{{ __('text.account') }}">
                </div>
                <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.account') }}
                    </div>
                    <div class="mb-2">
                        <ul class="list-disc list-inside space-y-1">
                            <li>{{ __('text.tester') }}</li>
                            <li>{{ __('text.notes') }}</li>
                            <li>{{ __('text.redirects') }}</li>
                            <li>{{ __('text.timetracking') }}</li>
                            <li>{{ __('text.rss-feeds') }}</li>
                            <li>{{ __('text.portfolio') }}</li>
                            <li>{{ __('text.cv') }}</li>
                        </ul>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="md:columns-2 columns-1 md:mb-8 md-0" id="portfolio">
        <!-- Card: Imprint -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-left">
            <a alt="{{ __('text.imprint') }}" title="{{ __('text.imprint') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.imprint')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/law.jpg') }}" alt="{{ __('text.imprint') }}" title="{{ __('text.imprint') }}">
                </div>
                <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.imprint') }}
                    </div>
                </div>
            </a>
        </div>

        <!-- Card: Data Protection -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-right">
            <a alt="{{ __('text.data-protection') }}" title="{{ __('text.data-protection') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.data-protection')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/law.jpg') }}" alt="{{ __('text.data-protection') }}" title="{{ __('text.data-protection') }}">
                </div>
                <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.data-protection') }}
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
