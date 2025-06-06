<div>
    <a alt="{{ __('text.back') }}" title="{{ __('text.back') }}" wire:navigate.hover href="{{url(Config::get('app.locale') ."/tester/")}}" class="flex gap-2 mb-4 align-center btn-back dark:invert dark:text-secondary-dark">
        <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}"  alt="{{ __('alt.back') }}" title="{{ __('alt.back') }}"/>
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
        <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}"  alt="{{ __('alt.add') }}" title="{{ __('alt.add') }}"/>
    </button>

    <div class="mb-3">
        <p class="mb-1">{{ __('text.sitemaps') }}</p>
        <textarea rows="3" class="w-full mb-2 rounded dark:bg-secondary-light" wire:model="sitemapsInput"></textarea>
        <div class="grid grid-cols-2 gap-5">
            <button class="btn" wire:click="runSitemaps" wire:loading.attr="disabled" wire:target="runSitemaps">
                <span wire:loading.remove wire:target="runSitemaps">{{ __('text.run_sitemaps') }}</span>
                <img wire:loading wire:target="runSitemaps" class="w-4 h-4 m-auto animate-spin invert" src="{{ Vite::asset('resources/icons/sync.svg') }}"  alt="{{ __('alt.sync') }}" title="{{ __('alt.sync') }}"/>
            </button>
            <button class="btn" wire:click="fetchAll">
                <span wire:loading.remove wire:target="fetchAll">{{ __('text.fetch_all') }}</span>
                <img wire:loading wire:target="fetchAll" class="w-4 h-4 m-auto animate-spin invert" src="{{ Vite::asset('resources/icons/sync.svg') }}"  alt="{{ __('alt.sync') }}" title="{{ __('alt.sync') }}"/>
            </button>
        </div>
        @if ($fetchStatus)
            <div wire:poll.1000ms="updateFetchStatus">
                {{ $fetchStatus['completed'] }} / {{ $fetchStatus['total'] }} {{ __('text.processed') }}
            </div>
        @endif
    </div>
    <a alt="{{ __('alt.compare') }}" title="{{ __('alt.compare') }}" class="btn mb-3 w-fit" href="{{url(Config::get('app.locale') . "/tester/testobject/{$testobject->id}/diff")}}">
        {{ __('text.bulk_diff') }}
    </a>
    <a alt="{{ __('alt.search') }}" title="{{ __('alt.search') }}" class="btn mb-3 w-fit" href="{{url(Config::get('app.locale') . "/tester/testobject/{$testobject->id}/search")}}">
        {{ __('text.search_html') }}
    </a>
    <button class="btn mb-3" wire:click="deleteAll">
        <span wire:loading.remove wire:target="deleteAll">{{ __('text.delete_all') }}</span>
        <img wire:loading wire:target="deleteAll" class="w-4 h-4 m-auto animate-spin invert" src="{{ Vite::asset('resources/icons/sync.svg') }}"  alt="{{ __('alt.sync') }}" title="{{ __('alt.sync') }}"/>
    </button>

    <p>{{ count($testobject->testruns) }} Testruns</p>

    @foreach ($testobject->testruns as $testrun)
        <div class="border px-3 mb-4 pb-3 rounded border-primary-dark dark:border-primary-light">
            <p><strong>{{ $testrun->name }}</strong></p>
            <p><strong>{{ __('text.created') }}:</strong> {{ $testrun->created_at_clean}}</p>
            <p><strong>{{ __('text.deleted') }}:</strong> {{ $testrun->deletedWhen()}}</p>

            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
                <button class="btn btn-delete" id="{{ $testrun->id }}" wire:click="deleteRun($event.target.id)" wire:confirm="Are you sure?">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/trash.svg') }}"  alt="{{ __('alt.delete') }}" title="{{ __('alt.delete') }}"/>
                </button>
                <a alt="{{ __('alt.view') }}" title="{{ __('alt.view') }}" class="btn btn-details" wire:navigate.hover href="{{url(Config::get('app.locale') . "/tester/testrun/{$testrun->id}")}}" >
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/eye.svg') }}"  alt="{{ __('alt.view') }}" title="{{ __('alt.view') }}"/>
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
