@extends('layouts.app', ['title' =>  __('text.testobject') . ' ' . $testobject->name, 'keywords' => __('keywords.tester'), 'active' => 'tester', 'activeTool' => 'tester'])

@section('content')
    <h1>{{ __('text.testobject') }} {{$testobject->name}}</h1>

    @livewire('testobject', ['testobject' => $testobject])
@endsection
