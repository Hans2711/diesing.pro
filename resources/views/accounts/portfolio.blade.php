@extends('layouts.account', ['title' => __('titles.portfolio'), 'active' => 'account', 'activeTool' => 'portfolio'])

@section('tool-content')
@vite(['resources/js/utils/editor.js'])

<livewire:portfolio-edit/>
@endsection
