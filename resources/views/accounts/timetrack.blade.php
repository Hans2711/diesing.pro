@extends('layouts.app', ['title' => __('titles.home'), 'description' => __('descriptions.home')])

@section('content')
    <h1>{{ __('text.timetracking') }}</h1>
    @livewire('timetrack', ['id' => $timetrack->id])
@endsection

