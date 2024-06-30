@extends('layouts.app', ['title' => 'Privater Bereich'])

@section('content')
    <h1>Privater Bereich</h1>

    @if ($isAuthenticated)
        <p class="text-green-800">Authentifiziert</p>

        @include('private.tools-sidebar', ['active' => ''])
    @else
        <p class="text-red-800">Nicht Authentifiziert</p>
        <form method="POST" action="#" class="mt-5">
            @csrf
            <label for="password" class="block mb-2">Passwort</label>
            <input type="password" name="password" class="rounded" />
        </form>
    @endif



@endsection

