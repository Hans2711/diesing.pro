@extends('layouts.account', ['title' => __('text.timetracking'), 'active' => 'timetracking', 'activeTool' => 'timetracking'])

@section('tool-content')
@vite(['resources/js/utils/clipboard.js'])
<livewire:timetrack-edit />
@endsection

