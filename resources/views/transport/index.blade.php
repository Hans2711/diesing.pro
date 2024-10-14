@extends('layouts.app', ['title' => 'Transport', 'active' => 'transport'])

@section('content')
    @vite(['resources/css/transport.css', 'resources/js/transport.js'])
    <h1>Transport</h1>

    <div class="stops-wrapper">
    <p>Loading</p>
    </div>
@endsection
