@extends('layouts.account', ['title' => __('titles.redirects'), 'active' => 'account', 'activeTool' => 'redirects'])

@section('tool-content')
@vite(['resources/js/utils/clipboard.js'])
<livewire:redirects />
@endsection
