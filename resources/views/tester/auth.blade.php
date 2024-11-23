@extends('layouts.app', ['title' => 'Tester Auth', 'active' => 'tester'])

@section('content')
    <h1>Tester Auth</h1>

    <form action="#" method="post" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="password" class="block mb-2">Password</label>
            <input type="password" name="password" id="password" autocomplete="off" class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
        </div>
        <div class="flex items-center justify-between">
            <button class="btn" type="submit">
                Sign In
            </button>
        </div>
    </form>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
@endsection
