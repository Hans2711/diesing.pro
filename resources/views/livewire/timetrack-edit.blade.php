<div>
    <button class="btn mb-3" wire:click="createTimetrack">
        <x-inline-svg icon="icons/add" class="w-20 h-5 invert" title="{{ __('alt.add') }}" />
    </button>

    @foreach ($timetracks as $timetrack)
    <div class="border px-3 mb-4 pb-3 rounded border-primary-dark dark:border-primary-light">
        <p>{{ $timetrack->title }}</p>
        <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
            <a alt="{{ __('alt.view') }}" title="{{ __('alt.view') }}" class="btn btn-details" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.timetracking') . '/' . $timetrack->id)}}" >
                <x-inline-svg icon="icons/eye" class="w-20 h-5 invert" title="{{ __('alt.view') }}" />
            </a>
            <button data-copy="true" data-text="{{url(Config::get('app.locale') . '/' . __('url.timetracking') . '/' . $timetrack->id)}}" class="justify-center w-full p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center edit-redirect">
                <x-inline-svg icon="icons/link-outline" class="w-10 h-5 invert" title="{{ __('alt.link') }}" />
            </button>
            <button class="btn btn-delete" id="{{ $timetrack->id }}" wire:click="deleteTimetrack($event.target.id)" wire:confirm="Are you sure?">
                <x-inline-svg icon="icons/trash" class="w-20 h-5 invert" title="{{ __('alt.delete') }}" />
            </button>
        </div>
    </div>
    @endforeach
</div>
