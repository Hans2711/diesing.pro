@extends('layouts.private', ['title' => 'Private Bereich', 'active' => 'private', 'activeTool' => 'none', 'hideToolbar' => true])

@section('tool-content')
    @if ($isAuthenticated)
        <div class="order-2 md:order-1 mt-4 md:mt-0 md:mr-4 md:w-auto">
            <p class="text-green-800">Authentifiziert</p>
        </div>
    @else
        <p class="text-red-800">Nicht Authentifiziert</p>
        <form method="POST" action="#" class="mt-5 ">
            @csrf
            @include('private.modals.parts.floating-label-input', ['id' => 'password', 'name' => 'password', 'label' => 'Password', 'wrapperClass' => 'col-span-2
            ', 'tabindex' => 1])
            <input type="hidden" value="" name="fingerprint" id="fingerprint" />
            <div class="mt-3 flex gap-3 w-full ">
                <button type="submit" class="btn">
                    <img class="w-20 h-6 invert" src="{{ Vite::asset('resources/icons/lock-open.svg') }}" />
                </button>
            </div>
        </form>

        <h2 class="mt-4">Session Ressurect</h2>
        <p>This works by Fingerprinting the Client Browser and matching it to the Public IP</p>
        <button class="btn" id="fingerprinting-button">Client</button>
        @vite(['resources/js/fingerprinting.js'])
        <div class="mt-3" id="fingerprinting">
        </div>
        <script type="template" id="fingerprinting-template">
            <div class="">
                <p class="text-lg">Complete Fingerprint</p>
                <p><%= visitorId %> </p>
            </div>
            <hr />
            <div class="">
                <p class="text-lg">Timezone:</p>
                <p><%= timezone %> </p>
            </div>
            <hr />
            <div class="">
                <p class="text-lg">WebGl Renderer:</p>
                <p><%= webGlRenderer %> </p>
            </div>
        </script>
    @endif
@endsection
