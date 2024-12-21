@extends('layouts.app', ['title' => 'Startseite'])

@section('content')
    @vite(['resources/js/utils/iphone-paralax.js'])
    <h1>{{ __('text.welcome') }}</h1>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/kontakt.jpg') }}');">
        <h2 class="parallax-text text-white md:text-black text-3xl">
            <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.contact'))}}">
                {{ __('text.contact') }}
            </a>
        </h2>
    </div>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/portfolio.jpg') }}');">
        <h2 class="parallax-text text-white text-3xl">
            <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.portfolio'))}}">
                {{ __('text.portfolio') }}
            </a>
        </h2>
    </div>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/private.jpg') }}');">
        <h2 class="parallax-text text-white text-3xl">
            <a wire:navigate.hover href="{{url('/privater-bereich')}}">
                {{ __('text.private-tools') }}
            </a>
        </h2>
    </div>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/law.jpg') }}');">
        <h2 class="parallax-text text-3xl">
            <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.imprint'))}}"> {{ __('text.imprint') }}</a>
            {{ __('text.and') }}
            <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.data-protection'))}}">{{ __('text.data-protection') }}</a>
        </h2>
    </div>



@endsection
