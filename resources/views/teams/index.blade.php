@extends('layouts.app', ['title' => 'Teams', 'active' => 'teams'])

@section('content')
<h1>{{ __('text.random-teams') }}</h1>
<livewire:random-teams />
@endsection
