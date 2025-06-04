<div>
    <a alt="{{ __('text.back') }}" title="{{ __('text.back') }}" wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.timetracking'))}}" class="flex gap-2 mb-4 align-center btn-back dark:text-secondary-dark dark:invert">
        <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}"  alt="{{ __('alt.back') }}" title="{{ __('alt.back') }}"/>
        <span class="leading-none">
            {{__('text.back')}}
        </span>
    </a>

    @include('global.partials.floating-label-input', [
    'id'           => 'title',
    'name'         => 'title',
    'label'        => 'Title',
    'wrapperClass' => 'w-full sm:w-auto mb-4',
    'tabindex'     => 1,
    'required'     => true,
    'additional'   => 'wire:model="timetrack.title"'
    ])

    <h3 class="font-semibold mb-2">Time tracks</h3>

    @foreach ($timetrack['times'] as $i => $track)
    <div class="flex flex-wrap items-end gap-3 mb-3">

        <input type="text"
            class="input rounded dark:bg-secondary-light"
            placeholder="Title"
            wire:model.defer="timetrack.times.{{ $i }}.title">

        <input type="datetime-local"
            class="input rounded dark:bg-secondary-light"
            wire:model.defer="timetrack.times.{{ $i }}.time">
    </div>
    <div class="flex flex-wrap items-start gap-3 mb-3">
        <input type="text"
            class="input rounded dark:bg-secondary-light"
            placeholder="e.g. 1h 30m"
            wire:model.defer="timetrack.times.{{ $i }}.duration">

        <input type="url"
            class="input flex-1 rounded dark:bg-secondary-light"
            placeholder="https://example.com"
            wire:model.defer="timetrack.times.{{ $i }}.link">

    </div>
    <button type="button"
        class="btn btn-delete mb-3" id="{{ $i }}"
        wire:click="removeTimeTrack($event.target.id)">✕</button>
    <hr class="w-full border-t border-gray-300 mb-3">
    @endforeach

    <button type="button" class="btn btn-edit mb-6" wire:click="addTimeTrack">
        + Add time track
    </button>

    <button class="btn" wire:click="updateTimetrack">
        <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/sync.svg') }}"  alt="{{ __('alt.sync') }}" title="{{ __('alt.sync') }}"/>
    </button>

    <div class="mt-3">
        @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    </div>
</div>
