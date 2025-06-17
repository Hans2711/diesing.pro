@extends('layouts.app', ['title' => __('titles.contact'), 'description' => __('descriptions.contact'), 'keywords' => __('keywords.contact'), 'active' => 'contact', 'activeTool' => $email])

@section('content')
    <h1>{{ __('text.contact') }}</h1>
    @livewire('contact-form', ['recipient' => $email])
@endsection
