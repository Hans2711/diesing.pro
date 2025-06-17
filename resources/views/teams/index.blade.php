@extends('layouts.app', ['title' => __('titles.random-teams'), 'description' => __('descriptions.random-teams'), 'keywords' => __('keywords.random-teams'), 'active' => 'teams'])

@section('content')
<h1>{{ __('text.random-teams') }}</h1>
<livewire:random-teams />
@endsection
