@extends('layouts.app', ['title' => 'Startseite'])

@section('content')
    <h1>Wilkommen bei diesing.pro</h1>
    <div class="paralax-image relative bg-red-900 shadow-md mb-10 h-56 flex justify-center items-center bg-cover bg-fixed bg-center" style="background-image: url({{ Vite::asset('resources/images/kontakt.jpg') }});">
        <h2 class="text-center">
            Wenn du <a href="{{url('/kontakt')}}">Kontakt</a> aufnehmen willst, klicke
            <a href="{{url('/kontakt')}}">hier</a>
        </h2>
    </div>

    <div class="paralax-image relative bg-red-900 shadow-md mb-10 h-56 flex justify-center items-center bg-cover bg-fixed bg-center" style="background-image: url({{ Vite::asset('resources/images/portfolio.jpg') }})">
        <h2 class="text-center text-white ">Wenn du mein <a href="{{url("/portfolio")}}">Portfolio</a> sehen willst, klicke <a href="{{url("/portfolio")}}">hier</a></h2>
    </div>

    <div class="paralax-image relative bg-red-900 shadow-md mb-10 h-56 flex justify-center items-center bg-cover bg-fixed bg-center" style="background-image: url({{ Vite::asset('resources/images/private.jpg') }})">
        <h2 class="text-center text-white "><a href="{{url("/privater-bereich")}}">Private Tools</a></a></p>
    </div>

    <div class="paralax-image relative bg-red-900 shadow-md mb-10 h-56 flex justify-center items-center bg-cover bg-fixed bg-center" style="background-image: url({{ Vite::asset('resources/images/law.jpg') }})">
        <h2 class="text-center "><a href="{{url("/impressum")}}">Impressum</a> und <a href="{{url("/datenschutz")}}">Datenschutzerklärung</a></a></p>
    </div>


@endsection
