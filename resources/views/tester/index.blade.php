@extends('layouts.app', ['title' => __('titles.tester'), 'description' => __('descriptions.tester'), 'active' => 'tester', 'activeTool' => 'tester'])

@section('content')
    <h1>Tester</h1>

    @livewire('testobjects')
@endsection
