<div>
    <button class="btn mb-3" wire:click="createTimetrack">
        <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}"  alt=""/>
    </button>

    @foreach ($timetracks as $timetrack)
    <div class="border px-3 mb-4 pb-3 rounded border-primary-dark dark:border-primary-light">
        <p>{{ $timetrack->title }}</p>
        <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
            <a alt="" class="btn btn-details" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.timetracking') . '/' . $timetrack->id)}}" >
                <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/eye.svg') }}"  alt=""/>
            </a>
            <button data-copy="true" data-text="{{url(Config::get('app.locale') . '/' . __('url.timetracking') . '/' . $timetrack->id)}}" class="justify-center w-full p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center edit-redirect">
                <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/link-outline.svg') }}"  alt=""/>
            </button>
            <button class="btn btn-delete" wire:click="deleteTimetrack({{$timetrack->id}})" wire:confirm="Are you sure?">
                <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/trash.svg') }}"  alt=""/>
            </button>
        </div>
    </div>
    @endforeach
</div>
