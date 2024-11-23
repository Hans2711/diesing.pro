@extends('layouts.app', ['title' => 'Startseite'])

@section('content')
    @vite(['resources/js/utils/iphone-paralax.js'])
    <h1>Wilkommen bei diesing.pro</h1>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/kontakt.jpg') }}');">
        <h2 class="parallax-text text-white md:text-black text-3xl">
            <a wire:navigate.hover href="{{url('/kontakt')}}">Kontakt</a>
        </h2>
    </div>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/portfolio.jpg') }}');">
        <h2 class="parallax-text text-white text-3xl">
            <a wire:navigate.hover href="{{url('/portfolio')}}">Portfolio</a>
        </h2>
    </div>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/private.jpg') }}');">
        <h2 class="parallax-text text-white text-3xl">
            <a wire:navigate.hover href="{{url('/privater-bereich')}}">Private Tools</a>
        </h2>
    </div>

    <div class="parallax-image" style="background-image: url('{{ Vite::asset('resources/images/law.jpg') }}');">
        <h2 class="parallax-text text-3xl">
            <a wire:navigate.hover href="{{url('/impressum')}}">Impressum</a> und
            <a wire:navigate.hover href="{{url('/datenschutz')}}">Datenschutz</a>
        </h2>
    </div>



@endsection
