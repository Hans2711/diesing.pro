@extends('layouts.app', ['title' => 'Privater Bereich'])

@section('content')
    @vite(['resources/js/notes.js'])
    <h1>Notizen</h1>
    @csrf
    <div class="flex flex-col md:flex-row md:justify-between w-full">
        <div class="order-2 md:order-1 mt-4 md:mt-0 md:mr-4 md:w-auto">
            <div class="flex items-center">
                <select name="notes" id="notes" class="rounded w-full md:w-auto">
                    @foreach ($notes as $note)
                        <option value="{{$note->id}}">{{$note->name}}</option>
                    @endforeach
                </select>
                <button class="ml-2 p-2 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center" id="add-note">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="ml-1">Add</span>
                </button>
                <button class="ml-2 p-2 bg-red-500 text-white rounded hover:bg-red-700 flex items-center" id="delete-note">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="ml-1">Delete</span>
                </button>
            </div>
            <br>
            <div class="relative w-full min-w-[200px]">
                <input type="text" name="noteName" id="note-name" class="rounded mb-4" />
                <textarea name="note" cols="100" rows="20" id="note" class="peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-blue-gray-200"  required></textarea>
            </div>
        </div>


        <div class="order-1 md:order-2 w-full md:w-1/5">
            @include('private.tools-sidebar', ['active' => 'notes'])
        </div>
    </div>
@endsection

