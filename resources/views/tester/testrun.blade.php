@extends('layouts.app', ['title' => __('text.testrun') . ' ' . $testrun->created_at_clean, 'active' => 'tester'])

@section('content')
    <h1>{{ __('text.testrun') }} {{$testrun->created_at_clean}}</h1>
    @livewire('testrun', ['testrun' => $testrun])
@endsection
