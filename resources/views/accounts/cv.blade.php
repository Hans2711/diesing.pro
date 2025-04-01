@extends('layouts.account', ['title' => __('text.cv'), 'active' => 'account', 'activeTool' => 'cv'])

@section('tool-content')

<livewire:cv-edit/>
@endsection
