@extends('layouts.private', ['title' => __('text.notes'), 'active' => 'private', 'activeTool' => 'notes'])

@section('tool-content')
@vite(['resources/js/utils/clipboard.js'])
<livewire:notes />
@endsection
