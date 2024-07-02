@extends('layouts.private', ['title' => 'Notizen', 'active' => 'private', 'activeTool' => 'notes'])

@section('tool-content')
@vite(['resources/js/notes.js'])
<div class="flex items-center">
    <select name="notes" id="notes" class="rounded w-full md:w-auto">
        @foreach ($notes as $note)
            <option value="{{$note->id}}">{{$note->name}}</option>
        @endforeach
    </select>
    <button class="ml-2 p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center" id="add-note">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </button>
    <button class="ml-2 p-2 py-2.5 px-4 bg-red-500 text-white rounded hover:bg-red-700 flex items-center" id="delete-note">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
<br>
<div class="relative w-full min-w-[200px]">
    <div class="flex items-start flex-col md:flex-row mb-4">
        @include('private.modals.parts.floating-label-input', ['id' => 'note-name', 'name' => 'noteName', 'label' => 'Name', 'wrapperClass' => 'w-full sm:w-auto'])
        <div class="flex flex-row items-center mt-4 md:mt-0 md:ml-2" id="share" >
            <div class="flex items-center ml-0 gap-x-3 border-solid border p-2 rounded" style="border-color: #6b7280;">
                <label>Teilen?</label>
                <label class="relative inline-flex cursor-pointer items-center">
                    <input id="switch-share" type="checkbox" class="peer sr-only" value="1" />
                    <label for="switch-2" class="hidden"></label>
                    <div class="peer h-4 w-11 rounded-full border bg-slate-200 after:absolute after:-top-1 after:left-0 after:h-6 after:w-6 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-300 peer-checked:after:translate-x-full peer-focus:ring-green-300"></div>
                </label>
            </div>
            <button class="ml-2 p-2 px-4 bg-green-500 text-white rounded hover:bg-green-700 hidden items-center" id="note-url-button">
                <svg height="24" class="filter-white-icon" viewBox="0 0 48 48" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h48v48H0z" fill="none"/><path d="M7.8 24c0-3.42 2.78-6.2 6.2-6.2h8V14h-8C8.48 14 4 18.48 4 24s4.48 10 10 10h8v-3.8h-8c-3.42 0-6.2-2.78-6.2-6.2zm8.2 2h16v-4H16v4zm18-12h-8v3.8h8c3.42 0 6.2 2.78 6.2 6.2s-2.78 6.2-6.2 6.2h-8V34h8c5.52 0 10-4.48 10-10s-4.48-10-10-10z"/></svg>
            </button>
        </div>
    </div>
    <textarea name="note" cols="100" rows="20" id="note" class="peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-blue-gray-200"  required></textarea>
</div>
@include('private.modals.share-modal')
@endsection

