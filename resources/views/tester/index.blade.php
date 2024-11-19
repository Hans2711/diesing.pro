@extends('layouts.app', ['title' => 'Tester', 'active' => 'tester'])

@section('content')
    <h1>Tester</h1>

    @livewire('testobjects')
@endsection
