@extends('layouts.account', ['title' => __('text.notes'), 'active' => 'account', 'activeTool' => 'notes'])

@section('tool-content')
@vite(['resources/js/utils/clipboard.js'])
<livewire:notes />
@endsection
