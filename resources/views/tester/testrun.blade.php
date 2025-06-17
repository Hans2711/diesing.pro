@extends('layouts.app', ['title' => __('text.testrun') . ' ' . $testrun->name . ' ' . $testrun->created_at_clean, 'keywords' => __('keywords.tester'), 'active' => 'tester', 'activeTool' => 'tester'])

@section('content')
    <h1>{{ __('text.testrun') }} {{$testrun->name}} {{$testrun->created_at_clean}}</h1>
    @livewire('testrun', ['testrun' => $testrun])
@endsection
