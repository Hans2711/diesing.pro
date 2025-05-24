@extends('layouts.account', ['title' => __('titles.notes'), 'active' => 'account', 'activeTool' => 'notes'])
@disableMinifier

@section('tool-content')
@vite(['resources/js/utils/clipboard.js'])
<livewire:notes />
@endsection
