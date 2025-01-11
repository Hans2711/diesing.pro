@extends('layouts.app', ['title' => 'Kontakt', 'active' => 'contact'])

@section('content')
    @vite(['resources/css/contact.css'])
    <h1>{{ __('text.contact') }}</h1>

    <livewire:contact-form />
@endsection
