@extends('layouts.app', ['title' => 'Privater Bereich'])

@section('content')
    <h1>Privater Bereich</h1>

    @if ($isAuthenticated)

        <div class="flex flex-col md:flex-row md:justify-between w-full">
            <div class="order-2 md:order-1 mt-4 md:mt-0 md:mr-4 md:w-auto">
                <p class="text-green-800">Authentifiziert</p>
            </div>

            <div class="order-1 md:order-2 w-full md:w-1/5">
                @include('private.tools-sidebar', ['active' => ''])
            </div>
        </div>

    @else
        <p class="text-red-800">Nicht Authentifiziert</p>
        <form method="POST" action="#" class="mt-5">
            @csrf
            <label for="password" class="block mb-2">Passwort</label>
            <input type="password" name="password" class="rounded" />
        </form>
    @endif



@endsection

