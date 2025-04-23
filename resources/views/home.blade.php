@extends('layouts.app', ['title' => __('titles.home'), 'description' => __('descriptions.home')])

@section('content')
    <h1>{{ __('text.welcome') }}</h1>

    <div class="md:columns-2 columns-1 md:mb-8 mb-0" id="portfolio">
        <!-- Card: Contact -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-left">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/kontakt.jpg') }}">
                </div>
                <div class="px-6 py-4">
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
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.cv')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/portfolio.jpg') }}">
                </div>
                <div class="px-6 py-4">
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
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.tester')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/testing.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.tester') }}
                    </div>
                    <div class="mb-2">
                        {{ __('text.tester-description') }}
                    </div>
                </div>
            </a>
        </div>
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-right">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/random.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.random-teams') }}
                    </div>
                    <div class="mb-2">
                        {{ __('text.random-teams-description') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="md:columns-2 columns-1 md:mb-8 md-0" id="portfolio">
        <!-- Card: Private Tools -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-left">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/private.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.account') }}
                    </div>
                    <div class="mb-2">
                        {{ __('text.account-description') }}
                    </div>
                </div>
            </a>
        </div>

        <!-- Card: Imprint & Data Protection -->
        <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-right">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.imprint')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-44">
                    <img class="absolute top-0 left-0 w-full h-44 object-cover" loading="lazy"
                         src="{{ Vite::asset('resources/images/law.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        <a href="{{ url(Config::get('app.locale') . '/' . __('url.imprint')) }}">{{ __('text.imprint') }}</a> {{ __('text.and') }} <a href="{{ url(Config::get('app.locale') . '/' . __('url.data-protection')) }}">{{ __('text.data-protection') }}</a>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
