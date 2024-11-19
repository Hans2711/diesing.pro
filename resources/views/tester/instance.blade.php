@extends('layouts.app', ['title' => 'Testinstance'])

@section('content')
    <h1>Testinstance {{$instance->created_at}}</h1>
    <p>HTML:</p>
    <textarea name="html" id="html" class="w-full p-2 border rounded " rows="20">{{$instance->html}}</textarea>
    <p>Headers:</p>
    <textarea name="headers" id="headers" class="w-full p-2 border rounded " rows="20">{{$instance->headers}}</textarea>

@endsection
