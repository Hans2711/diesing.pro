<div>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') . '/' . __('url.account') . '/' . __('url.timetracking'))}}" class="flex gap-2 mb-4 align-center btn-back">
        <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}" />
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
            <input  type="text"
                    class="input w-40 rounded"
                    placeholder="title"
                    wire:model.defer="timetrack.times.{{ $i }}.title">

            {{-- datetime-local includes date + time --}}
            <input  type="datetime-local"
                    class="input w-56 rounded"
                    wire:model.defer="timetrack.times.{{ $i }}.time">

            {{-- free-form duration like “1h 30m” --}}
            <input  type="text"
                    class="input w-32 rounded"
                    placeholder="e.g. 1h 30m"
                    wire:model.defer="timetrack.times.{{ $i }}.duration">

            <button type="button"
                    class="btn btn-sm"
                    wire:click="removeTimeTrack({{ $i }})">
                ✕
            </button>
        </div>
    @endforeach

    <button type="button" class="btn btn-outline mb-6" wire:click="addTimeTrack">
        + Add time track
    </button>

    <button class="btn" wire:click="updateTimetrack">
        <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/sync.svg') }}" />
    </button>

    <div class="mt-3">
        @if (session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    </div>
</div>
