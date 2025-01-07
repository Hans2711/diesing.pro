<div>
    <button wire:click="addRedirect" class="p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center" id="add-redirect">
        <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" />
    </button>
    <div class="mt-3 w-full" id="redirects-wrapper">
        @foreach ($redirects ?? [] as $redirect)
            <div class="p-3 mt-5 rounded border-solid border w-full" style="border-color: #6b7280; overflow: overlay;">
                @if (isset($selectedRedirect['id']) && $redirect->id == $selectedRedirect['id'])
                    <!-- Edit Redirect Form -->
                    <form wire:submit.prevent="updateRedirect">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start sm:items-center text-left">
                            <div class="">
                                <label for="edit-name" class="font-bold text-lg">Name</label>
                                <input id="edit-name" type="text" wire:model="selectedRedirect.name" class="w-full p-2 border rounded" />
                            </div>
                            <div class="">
                                <label for="edit-target" class="font-bold text-lg">Target</label>
                                <input id="edit-target" type="text" wire:model="selectedRedirect.target" class="w-full p-2 border rounded" />
                            </div>
                            <div class="">
                                <label for="edit-code" class="font-bold text-lg">HTTP Code</label>
                                <select id="edit-code" wire:model="selectedRedirect.code" class="w-full p-2 border rounded">
                                    <option value="301">301</option>
                                    <option value="302">302</option>
                                    <option value="307">307</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 mt-3">
                            <button type="button" wire:click="cancelEdit" class="bg-red-500 p-2 py-2.5 px-4 text-white rounded hover:bg-gray-700">
                                <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" />
                            </button>
                            <button type="submit" class="p-2 py-2.5 px-4 bg-green-500 text-white rounded hover:bg-green-700">
                                <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/save-outline.svg') }}" />
                            </button>
                        </div>
                    </form>
                @else
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start sm:items-center text-left">
                        <div class="">
                            <p class="font-bold text-lg">Name</p>
                            <p class="overflow-hidden">{{ $redirect->name }}</p>
                        </div>
                        <div class="">
                            <p class="font-bold text-lg">Target</p>
                            <p class="overflow-hidden">{{ $redirect->target }}</p>
                        </div>
                        <div class="">
                            <p class="font-bold text-lg">HTTP Code</p>
                            <p>{{ $redirect->code }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 mt-2">
                        <button wire:click="deleteRedirect({{ $redirect->id }})" wire:confirm="{{ __('text.are-you-sure') }}" class="justify-center w-full p-2 py-2.5 px-4 bg-red-500 text-white rounded hover:bg-red-700 flex items-center delete-redirect" id="delete-redirect" data-id="{{ $redirect->id }}">
                            <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" />
                        </button>
                        <button wire:click="editRedirect({{ $redirect->id }})" id="e-{{ $redirect->id }}" class="justify-center w-full p-2 py-2.5 px-4 bg-green-500 text-white rounded hover:bg-green-700 flex items-center edit-redirect">
                            <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/pencil-outline.svg') }}" />
                        </button>
                        <button data-copy="true" data-text="{{ $redirect->url }}" class="justify-center w-full p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center edit-redirect">
                            <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/link-outline.svg') }}" />
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
