@extends('layouts.app', ['title' => 'Tester Auth', 'active' => 'tester', 'activeTool' => 'tester'])

@section('content')
    <h1>Tester</h1>

    {!! __('text.tester-disclaimer') !!}

    <form action="#" method="post" class="mb-5 mt-5">
        @csrf
        <div class="mb-3">
            <label for="password" class="block mb-2">{{ __('text.password') }}</label>
            <input type="password" name="password" id="password" autocomplete="off" class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button class="btn" type="submit">
                <img class="w-20 h-6 invert" src="{{ Vite::asset('resources/icons/lock-open.svg') }}" />
            </button>
        </div>
    </form>
    @if (session()->has('message'))
        <div class="alert alert-error">{{ session('message') }}</div>
    @endif
@endsection
