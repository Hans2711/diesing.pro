<div>
    <a wire:navigate.hover href="{{url(Config::get('app.locale') ."/tester/")}}" class="flex gap-2 mb-4 align-center btn-back dark:invert dark:text-secondary-dark">
        <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}" />
        <span class="leading-none">
            {{__('text.back')}}
        </span>
    </a>

    <p>
        {{__('text.autodelete-after')}}
    </p>
    <select class="mb-3 rounded dark:bg-secondary-light" wire:change="updateDeleteAfter($event.target.value)">
        @foreach ($deleteAfterOptions as $int => $option)
            <option value="{{$int}}" @if ($testobject->delete_after == $int) selected @endif>{{$option}}</option>
        @endforeach
    </select>

    <button class="btn mb-3" wire:click="createRun">
        <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" />
    </button>

    <button class="btn mb-3" wire:click="crawlDomain">
        {{ __('text.crawl') }}
    </button>
    <button class="btn mb-3" wire:click="fetchAll">
        {{ __('text.fetch_all') }}
    </button>
    <button class="btn mb-3" wire:click="bulkDiff">
        {{ __('text.bulk_diff') }}
    </button>

    {!! $bulkDiffContent ?? '' !!}

    @foreach ($testobject->testruns as $testrun)
        <div class="border px-3 mb-4 pb-3 rounded border-primary-dark dark:border-primary-light">
            <p><strong>{{ $testrun->name }}</strong></p>
            <p><strong>{{ __('text.created') }}:</strong> {{ $testrun->created_at_clean}}</p>
            <p><strong>{{ __('text.deleted') }}:</strong> {{ $testrun->deletedWhen()}}</p>

            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
                <button class="btn btn-delete" wire:click="deleteRun({{$testrun->id}})" wire:confirm="Are you sure?">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/trash.svg') }}" />
                </button>
                <a class="btn btn-details" wire:navigate.hover href="{{url(Config::get('app.locale') . "/tester/testrun/{$testrun->id}")}}" >
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/eye.svg') }}" />
                </a>
            </div>
        </div>
    @endforeach

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
