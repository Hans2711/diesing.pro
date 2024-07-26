@extends('layouts.minimal', ['title' => 'Passwort', 'active' => 'private', 'activeTool' => 'redirector', 'hideToolbar' => false])

@section('content')
    <form action="#" method="POST">
        @csrf

        @include('private.modals.parts.floating-label-input', ['id' => 'password', 'name' => 'password', 'label' => 'Passwort'])
        <input type="submit" name="submit" value="Abschicken" class=" bg-gradient-to-br from-rose-700 via-purple-700 hover:cursor-pointer to-gray-500 hover:to-gray-500 hover:via-purple-700 hover:from-gray-500 text-white mt-5 inline-flex w-full justify-center rounded-md bg-green-300 px-3 py-3 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" />
    </form>
@endsection