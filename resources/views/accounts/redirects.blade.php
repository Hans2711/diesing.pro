@extends('layouts.account', ['title' => __('text.redirects'), 'active' => 'account', 'activeTool' => 'redirects'])

@section('tool-content')
@vite(['resources/js/utils/clipboard.js'])
<livewire:redirects />
@endsection
