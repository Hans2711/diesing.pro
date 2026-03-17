@extends('layouts.app', ['title' => __('titles.home'), 'description' => __('descriptions.home'), 'keywords' => __('keywords.home'), 'dark' => false])

@section('content')
<h1>{{ __('text.welcome') }}</h1>

{{-- Search Bar --}}
<x-search-bar />

<div class="md:columns-2 columns-1 md:mb-8 mb-0" id="portfolio">
    <!-- Card: Contact -->
    <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card-left">
        <a alt="{{ __('text.contact') }}" title="{{ __('text.contact') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.contact')) }}" wire:navigate.hover >
            <div class="relative h-0 pb-44">
                <x-responsive-image 
                    src="resources/images/kontakt.webp" 
                    alt="{{ __('alt.card-contact') }}"
                    title="{{ __('text.contact') }}"
                    class="absolute top-0 left-0 w-full h-44 object-cover"
                    fetchpriority="high"
                    loading="eager"
                />
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
                <x-responsive-image 
                    src="resources/images/portfolio.webp" 
                    alt="{{ __('alt.card-portfolio') }}"
                    title="{{ __('text.cv') }}"
                    class="absolute top-0 left-0 w-full h-44 object-cover"
                    loading="lazy"
                />
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
                <x-responsive-image 
                    src="resources/images/random.webp" 
                    alt="{{ __('alt.card-random-teams') }}"
                    title="{{ __('text.random-teams') }}"
                    class="absolute top-0 left-0 w-full h-44 object-cover"
                    loading="lazy"
                />
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
                <x-responsive-image 
                    src="resources/images/rt-share.webp" 
                    alt="{{ __('alt.card-rt-share') }}"
                    title="{{ __('text.rt-share') }}"
                    class="absolute top-0 left-0 w-full h-44 object-cover"
                    loading="lazy"
                />
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
    <div class="w-full rounded overflow-hidden shadow-lg mt-4 md:mt-0 home-card">
        <a alt="{{ __('text.account') }}" title="{{ __('text.account') }}" href="{{ url(Config::get('app.locale') . '/' . __('url.account')) }}" wire:navigate.hover >
            <div class="relative h-0 pb-44">
                <x-responsive-image 
                    src="resources/images/private.webp" 
                    alt="{{ __('alt.card-account') }}"
                    title="{{ __('text.account') }}"
                    class="absolute top-0 left-0 w-full h-44 object-cover"
                    loading="lazy"
                />
            </div>
            <div class="px-6 py-4 bg-primary-dark text-white dark:bg-primary">
                <div class="font-bold text-xl mb-2">
                    {{ __('text.account') }}
                </div>
                <div class="mb-2">
                    <ul class="space-y-1">
                        <li class="relative pl-5">
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-2 w-2 bg-white"></span>
                            <a wire:navigate.hover
                                href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.notes')) }}"
                                alt="{{ __('text.notes') }}"
                                title="{{ __('text.notes') }}"
                                class="font-semibold hover:underline">
                                {{ __('text.notes') }}
                            </a>
                        </li>
                        <li class="relative pl-5">
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 h-2 w-2 bg-white"></span>
                            <a wire:navigate.hover
                                href="{{ url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.redirects')) }}"
                                alt="{{ __('text.redirects') }}"
                                title="{{ __('text.redirects') }}"
                                class="font-semibold hover:underline">
                                {{ __('text.redirects') }}
                            </a>
                        </li>
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
                <x-responsive-image 
                    src="resources/images/law.webp" 
                    alt="{{ __('alt.card-imprint') }}"
                    title="{{ __('text.imprint') }}"
                    class="absolute top-0 left-0 w-full h-44 object-cover"
                    loading="lazy"
                />
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
                <x-responsive-image 
                    src="resources/images/law.webp" 
                    alt="{{ __('alt.card-data-protection') }}"
                    title="{{ __('text.data-protection') }}"
                    class="absolute top-0 left-0 w-full h-44 object-cover"
                    loading="lazy"
                />
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
