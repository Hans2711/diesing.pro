@extends('layouts.app', ['title' => 'Testobject', 'active' => 'tester'])

@section('content')
    <h1>Testobject {{$testobject->name}}</h1>

    @livewire('testobject', ['testobject' => $testobject])
@endsection
