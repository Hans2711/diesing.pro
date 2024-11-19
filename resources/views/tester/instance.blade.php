@extends('layouts.app', ['title' => 'Testinstance', 'active' => 'tester'])

@section('content')
    <h1>Testinstance {{$instance->created_at}}</h1>
    <p><strong>HTML:</strong></p>
    <textarea name="html" id="html" class="w-full p-2 border rounded " rows="20">{{$instance->html}}</textarea>
    <p><strong>Headers:</strong></p>
    <textarea name="headers" id="headers" class="w-full p-2 border rounded " rows="20">{{$instance->headers}}</textarea>

@endsection
