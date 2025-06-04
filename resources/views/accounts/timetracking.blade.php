@extends('layouts.account', ['title' => __('text.timetracking'), 'active' => 'timetracking', 'activeTool' => 'timetracking'])

@section('tool-content')
<livewire:timetrack-edit />
@endsection

