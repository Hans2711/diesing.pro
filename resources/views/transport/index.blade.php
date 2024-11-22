@extends('layouts.app', ['title' => 'Transport', 'active' => 'transport'])

@section('content')
    @vite(['resources/js/utils/mapHandler.js'])
    <script>
        window.MAPS_API_KEY = `{{ env('MAPS_API_KEY') }}`;
    </script>
    <h1>Transport</h1>

    <div class="grid grid-cols-3 gap-1 w-full max-w-md bg-white mb-3 border-b-2">
        <a href="#" class="col-span-1 py-2 text-center text-purple-600 font-bold border-b-2 border-purple-600">
            Near by
        </a>
        <a href="#" class="col-span-1 py-2 text-center text-gray-500 hover:text-purple-600">
            Ride Finder
        </a>
        <a href="#" class="col-span-1 py-2 text-center text-gray-500 hover:text-purple-600">
            Journeys
        </a>
    </div>

    <livewire:transport />
    <livewire:stop-details />
    <livewire:stop-trips />
@endsection

