@extends('layouts.app', ['title' => __('text.timetracking'), 'description' => __('descriptions.home'), 'keywords' => __('keywords.home')])

@section('content')
    <h1>{{ __('text.timetracking') }}</h1>
    @livewire('timetrack', ['id' => $timetrack->id])
@endsection

