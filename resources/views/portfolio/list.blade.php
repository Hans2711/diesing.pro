@extends('layouts.app', ['title' => __('titles.portfolio'), 'description' => __('descriptions.portfolio'), 'active' => 'portfolio'])

@section('content')
    <h1>{{ __('text.portfolio') }}</h1>

    <livewire:portfolio />
@endsection
