@extends('layouts.app', ['title' => 'Startseite'])

@section('content')
    <h1>{{ __('text.welcome') }}</h1>

    <div class="md:columns-2 columns-1 md:mb-8 mb-0" id="portfolio">
        <!-- Card: Contact -->
        <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-32">
                    <img class="absolute top-0 left-0 w-full h-32 object-cover"
                         src="{{ Vite::asset('resources/images/kontakt.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.contact') }}
                    </div>
                </div>
            </a>
        </div>

        <!-- Card: Portfolio -->
        <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.portfolio')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-32">
                    <img class="absolute top-0 left-0 w-full h-32 object-cover"
                         src="{{ Vite::asset('resources/images/portfolio.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.portfolio') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="md:columns-2 columns-1 md:mb-8 md-0" id="portfolio">
        <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.tester')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-32">
                    <img class="absolute top-0 left-0 w-full h-32 object-cover"
                         src="{{ Vite::asset('resources/images/testing.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.tester') }}
                    </div>
                </div>
            </a>
        </div>
        <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.teams')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-32">
                    <img class="absolute top-0 left-0 w-full h-32 object-cover"
                         src="{{ Vite::asset('resources/images/random.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.random-teams') }}
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="md:columns-2 columns-1 md:mb-8 md-0" id="portfolio">
        <!-- Card: Private Tools -->
        <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
            <a href="{{ url('/privater-bereich') }}" wire:navigate.hover >
                <div class="relative h-0 pb-32">
                    <img class="absolute top-0 left-0 w-full h-32 object-cover"
                         src="{{ Vite::asset('resources/images/private.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.private-tools') }}
                    </div>
                </div>
            </a>
        </div>

        <!-- Card: Imprint & Data Protection -->
        <div class="max-w-lg rounded overflow-hidden shadow-lg mt-4 md:mt-0">
            <a href="{{ url(Config::get('app.locale') . '/' . __('url.imprint')) }}" wire:navigate.hover >
                <div class="relative h-0 pb-32">
                    <img class="absolute top-0 left-0 w-full h-32 object-cover"
                         src="{{ Vite::asset('resources/images/law.jpg') }}">
                </div>
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">
                        {{ __('text.imprint') }} {{ __('text.and') }} {{ __('text.data-protection') }}
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
