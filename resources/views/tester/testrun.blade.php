@extends('layouts.app', ['title' => 'Testrun'])

@section('content')
    <h1>Testrun {{$testrun->created_at}}</h1>

    @livewire('testrun', ['testrun' => $testrun])
@endsection
