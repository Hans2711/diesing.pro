@extends('layouts.app', ['title' =>  __('text.testobject') . ' ' . $testobject->name, 'active' => 'tester'])

@section('content')
    <h1>{{ __('text.testobject') }} {{$testobject->name}}</h1>

    @livewire('testobject', ['testobject' => $testobject])
@endsection
