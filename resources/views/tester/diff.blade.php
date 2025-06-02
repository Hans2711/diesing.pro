@extends('layouts.minimal', ['Diff' => 'Tester', 'active' => 'tester'])

@section('content')
    @vite(['resources/css/diff-table.css'])

    @if (isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @else
        <h1>Diff: <a alt="{{ __('text.testobject') }}" title="{{ __('text.testobject') }}" href="{{$testobject->url}}" class="underline">{{$testobject->name}} {{$testrun->name}}</a> ({{$testrun->created_at}})</h1>
        {!! $diff !!}
    @endif
@endsection
