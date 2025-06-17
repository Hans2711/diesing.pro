@extends('layouts.app', ['title' =>  __('text.testobject') . ' ' . $testobject->name, 'keywords' => __('keywords.tester'), 'active' => 'tester', 'activeTool' => 'tester'])

@section('content')
    @vite(['resources/css/diff-table.css'])
    @livewire('testobject-diff', ['testobject' => $testobject])
@endsection

