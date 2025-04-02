@extends('layouts.account', ['title' => __('text.cv'), 'active' => 'account', 'activeTool' => 'cv'])

@section('tool-content')
@vite(['resources/js/utils/editor.js'])

<livewire:cv-edit/>
@endsection
