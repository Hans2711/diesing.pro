@extends('layouts.app', ['title' => __('text.testinstance') . ' ' . $instance->created_at_clean, 'active' => 'tester', 'activeTool' => 'tester'])

@section('content')
    <h1>{{ __('text.testinstance') }} {{$instance->created_at_clean}}</h1>
    <a alt="" wire:navigate.hover href="{{url(Config::get('app.locale') . "/tester/testrun/{$instance->testrun->id}")}}" class="flex gap-2 mb-4 align-center btn-back dark:text-secondary-dark dark:invert">
        <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}"  alt=""/>
        <span class="leading-none">
            {{__('text.back')}}
        </span>
    </a>
    <p><strong>HTML:</strong></p>
    <textarea name="html" id="html" class="w-full p-2 border rounded dark:bg-secondary-light" rows="20">{{$instance->html}}</textarea>
    <p><strong>Headers:</strong></p>
    <textarea name="headers" id="headers" class="w-full p-2 border rounded dark:bg-secondary-light" rows="20">{{$instance->headers}}</textarea>

@endsection
