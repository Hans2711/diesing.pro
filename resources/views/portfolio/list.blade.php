@extends('layouts.app', ['title' => 'Portfolio', 'active' => 'portfolio'])

@section('content')
    <h1>{{ __('text.portfolio') }}</h1>

    <livewire:portfolio />
@endsection
