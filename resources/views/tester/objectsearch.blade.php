@extends('layouts.app', ['title' =>  __('text.testobject') . ' ' . $testobject->name, 'keywords' => __('keywords.tester'), 'active' => 'tester', 'activeTool' => 'tester'])

@section('content')
    @livewire('testobject-search', ['testobject' => $testobject])
@endsection
