<div>
    <button class="btn mb-3" wire:click="createTimetrack">
        <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" />
    </button>

    @foreach ($timetracks as $timetrack)
    <div class="border border-gray-200 px-3 mb-4 pb-3 rounded">
        <p>{{ $timetrack->title }}</p>
        <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
            <a class="btn btn-details" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.timetracking') . '/' . $timetrack->id)}}" >
                <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/eye.svg') }}" />
            </a>
            <button data-copy="true" data-text="{{url(Config::get('app.locale') . '/' . __('url.timetracking') . '/' . $timetrack->id)}}" class="justify-center w-full p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center edit-redirect">
                <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/link-outline.svg') }}" />
            </button>
            <button class="btn btn-delete" wire:click="deleteTimetrack({{$timetrack->id}})" wire:confirm="Are you sure?">
                <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/trash.svg') }}" />
            </button>
        </div>
    </div>
    @endforeach
</div>
