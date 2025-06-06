<div>
    <button wire:click="addFeed" class="btn" id="add-feed">
        <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" alt="{{ __('alt.add') }}" title="{{ __('alt.add') }}"/>
    </button>
    <div class="mt-3 w-full">
        @foreach ($feeds ?? [] as $feed)
        <div class="p-3 mt-5 rounded border-solid border w-full" style="border-color: #6b7280;">
            @if (isset($selectedFeed['id']) && $feed->id == $selectedFeed['id'])
            <form wire:submit.prevent="updateFeed">
                <label for="edit-name" class="font-bold text-lg">{{ __('text.name') }}</label>
                <input id="edit-name" type="text" wire:model="selectedFeed.name" class="w-full p-2 border rounded dark:bg-secondary-light" />
                <label for="edit-url" class="font-bold text-lg mt-2">URL</label>
                <input id="edit-url" type="text" wire:model="selectedFeed.url" class="w-full p-2 border rounded dark:bg-secondary-light" />
                <div class="flex justify-end gap-3 mt-3">
                    <button type="button" wire:click="cancelEdit" class="btn btn-delete">
                        <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" alt="{{ __('alt.close') }}" title="{{ __('alt.close') }}"/>
                    </button>
                    <button type="submit" class="btn btn-fetch">
                        <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/save-outline.svg') }}" alt="{{ __('alt.save') }}" title="{{ __('alt.save') }}"/>
                    </button>
                </div>
            </form>
            @else
            <div class="flex justify-between">
                <div>
                    <span class="font-bold">{{ $feed->name }}</span>
                    <p class="break-all text-sm">{{ $feed->url }}</p>
                </div>
                <span class="text-sm text-gray-500">{{ $feed->updated_at->format('d.m.Y H:i') }}</span>
            </div>
            <div class="grid grid-cols-2 gap-5 mt-2">
                <button id="{{ $feed->id }}" wire:click="deleteFeed($event.target.id)" class="btn btn-delete" type="button" wire:confirm="{{ __('text.are-you-sure') }}">
                    <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" alt="{{ __('alt.close') }}" title="{{ __('alt.close') }}"/>
                </button>
                <button id="{{ $feed->id }}" wire:click="editFeed($event.target.id)" class="btn btn-edit">
                    <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/pencil-outline.svg') }}" alt="{{ __('alt.edit') }}" title="{{ __('alt.edit') }}"/>
                </button>
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
