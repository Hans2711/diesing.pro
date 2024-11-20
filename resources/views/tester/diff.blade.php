@extends('layouts.minimal', ['Diff' => 'Tester', 'active' => 'tester'])

@section('content')
    @vite(['resources/css/diff-table.css'])

    @if (isset($error))
        <div class="alert alert-danger">{{ $error }}</div>
    @else
        <h1>Diff: <a href="{{$testobject->url}}">{{$testobject->name}}</a> ({{$testrun->created_at}})</h1>
        {!! $diff !!}
    @endif
@endsection
