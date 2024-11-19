@extends('layouts.app', ['title' => 'Testobject'])

@section('content')
    <h1>Testobject {{$testobject->name}}</h1>

    @livewire('testobject', ['testobject' => $testobject])
@endsection
