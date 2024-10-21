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

    <div class="stop-modal-wrapper hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
      <div class="stop-modal-background fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="stop-wrapper p-4 relative transform overflow-hidden rounded-lg bg-white text-left transition-all sm:w-full sm:max-w-lg">
              <p>Stops</p>
            </div>
            <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button" class=" close-button mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Close</button>
            </div>
            </div>
        </div>
      </div>
    </div>

    @include('transport.templates.stops-list-template')
    @include('transport.templates.stops-loader-template')
    @include('transport.templates.stops-error-template')
    @include('transport.templates.stop-template')
    @include('transport.templates.trips-template')

@endsection
