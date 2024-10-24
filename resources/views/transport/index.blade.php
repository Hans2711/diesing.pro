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

    @include('transport.modals.stop-modal')

    <div id="loader-spinner" class="hidden fixed left-3 top-3 z-30 border-gray-300 h-20 w-20 animate-spin rounded-full border-8 border-t-blue-600"></div>

    @include('transport.templates.stops-list-template')
    @include('transport.templates.stops-loader-template')
    @include('transport.templates.stops-error-template')
    @include('transport.templates.stop-template')
    @include('transport.templates.trips-template')
    @include('transport.templates.trip-details-template')
    @include('transport.templates.stops-timeline-template')

@endsection
