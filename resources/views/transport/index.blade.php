@extends('layouts.app', ['title' => 'Transport', 'active' => 'transport'])

@section('content')
    @vite(['resources/css/transport.css', 'resources/js/transport.js'])
    <script>
        window.MAPS_API_KEY = `{{ env('MAPS_API_KEY') }}`;
    </script>
    <h1>Transport</h1>

    <button class="hard-reload-stops t-button">Hard Reload</button>

    <input type="text" placeholder="Search" id="search" />

    <div class="stops-wrapper grid grid-cols-1 md:grid-cols-3 gap-4"></div>

    <div class="stop-wrapper"></div>

    @include('transport.templates.stops-list-template')
    @include('transport.templates.stops-loader-template')
    @include('transport.templates.stops-error-template')

@endsection
