@extends('layouts.app', ['title' => __('titles.contact'), 'description' => __('descriptions.contact'), 'active' => 'contact', 'activeTool' => $email])

@section('content')
    <h1>{{ __('text.contact') }}</h1>
    @livewire('contact-form', ['recepient' => $email])
@endsection
