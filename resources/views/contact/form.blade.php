@extends('layouts.app', ['title' => 'Kontakt', 'active' => 'contact'])

@section('content')
    <h1>{{ __('text.contact') }}</h1>
    <livewire:contact-form />
@endsection
