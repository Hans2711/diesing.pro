@extends('layouts.private', ['title' => 'Weiterleitungen', 'active' => 'private', 'activeTool' => 'redirector', 'hideToolbar' => false])

@section('tool-content')
@vite(['resources/js/redirects.js'])
    <button class="p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center" id="add-redirect">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </button>

    <div class="mt-3" id="redirects-wrapper">
        @include('private.parts.redirect-list', ['redirects' => $redirects ?? []])
    </div>

    @include('private.modals.redirect-modal')
@endsection
