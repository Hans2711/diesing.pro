<div>
    <div class="flex items-center">
        <select name="notes" id="notes" wire:change="updateSelectedNote($event.target.value)" class="rounded w-full md:w-auto dark:bg-secondary-light" tabindex="0">
            @foreach ($notes as $note)
                <option value="{{$note->id}}" {{ ($note->id === $selectedNote->id) ? 'selected' : '' }}>{{$note->name}}</option>
            @endforeach
        </select>
        <button wire:click="addNote" class="ml-2 btn btn-details" id="add-note">
            <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" />
        </button>
        <button wire:click="deleteNote" wire:confirm="{{ __('text.are-you-sure') }}" class="ml-2 btn btn-delete" id="delete-note">
            <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" />
        </button>
    </div>
    <br>
    <div class="relative w-full min-w-[200px]">
        <div class="flex items-start flex-col md:flex-row mb-4">
            @include('global.partials..floating-label-input', ['additional' => 'wire:change="updateNoteName($event.target.value)"' , 'id' => 'note-name', 'name' => 'noteName', 'value' => $selectedNote->name, 'label' => 'Name', 'wrapperClass' => 'w-full md:w-auto', 'tabindex' => 1])
            <div class="flex flex-row items-center mt-4 md:mt-0 md:ml-2" id="share" >
                <div class="flex items-center ml-0 gap-x-3 border-solid border p-2 rounded" style="border-color: #6b7280;">
                    <label>{{ __('text.share') }}</label>
                    <label class="relative inline-flex cursor-pointer items-center">
                        <input tabindex="-1" id="switch-share" wire:change="updateShare($event.target.checked)" type="checkbox" class="peer sr-only" value="1" {{ $selectedNote->share ? 'checked' : '' }} />
                        <label for="switch-2" class="hidden"></label>
                        <div class="peer h-4 w-11 rounded-full border bg-slate-200 after:absolute after:-top-1 after:left-0 after:h-6 after:w-6 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-green-300 peer-checked:after:translate-x-full peer-focus:ring-green-300"></div>
                    </label>
                </div>
                <button data-copy="true" data-text="{{ $selectedNote->getPublicUrl() }}" class="{{ $selectedNote->share ? '' : 'hidden' }} ml-2 btn btn-diff" id="add-note">
                    <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/link-outline.svg') }}" />
                </button>
            </div>
        </div>
        <textarea name="note" wire:change="updateNoteContent($event.target.value)" tabindex="2" cols="100" rows="20" id="note" class="peer h-full min-h-[100px] w-full resize-none rounded-[7px] border border-blue-gray-200 dark:bg-secondary-light"  required>{{ $selectedNote->content }}</textarea>
    </div>
</div>
