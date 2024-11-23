@extends('layouts.private', ['title' => 'Private Bereich', 'active' => 'private', 'activeTool' => 'none', 'hideToolbar' => true])

@section('tool-content')
    @if ($isAuthenticated)
        <div class="order-2 md:order-1 mt-4 md:mt-0 md:mr-4 md:w-auto">
            <p class="text-green-800">Authentifiziert</p>
        </div>
    @else
        <p class="text-red-800">Nicht Authentifiziert</p>
        <form method="POST" action="#" class="mt-5">
            @csrf
            <label for="password" class="block mb-2">Passwort</label>
            <input type="password" autocomplete="off" name="password" class="rounded" />
        </form>
    @endif
@endsection

