@extends('layouts.app', ['title' =>  __('text.testobject') . ' ' . $testobject->name, 'active' => 'tester'])

@section('content')
    @vite(['resources/css/diff-table.css'])
    @livewire('testobject-diff', ['testobject' => $testobject])
@endsection

