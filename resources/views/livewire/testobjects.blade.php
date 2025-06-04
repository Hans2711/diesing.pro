<div>
    <!-- New Testobject Form -->
    @if (!$testobject)
        <div class="border px-3 pb-5 mb-4 rounded border-primary-dark dark:border-primary-light">
            <h2>{{ __('text.new-testobject') }}</h2>

            <form wire:submit.prevent="createObject">
                @include('global.partials..floating-label-input', [
                    'id' => 'name',
                    'name' => 'name',
                    'label' => 'Name',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 1,
                    'required' => true,
                    'livewire' => true
                ])
                @include('global.partials..floating-label-input', [
                    'id' => 'url',
                    'name' => 'url',
                    'label' => 'Url',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 2,
                    'required' => true,
                    'livewire' => true
                ])
                <button type="submit" class="btn">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}"  alt="{{ __('alt.add') }}" title="{{ __('alt.add') }}"/>
                </button>
            </form>
        </div>
    @endif

    <!-- Update Testobject Form -->
    @if ($testobject)
        <div class="border px-3 pb-5 mb-4 rounded border-primary-dark dark:border-primary-light">
            <h2>Update {{ $testobject->name }}</h2>

            <form wire:submit.prevent="updateObject">
                @include('global.partials..floating-label-input', [
                    'id' => 'name',
                    'name' => 'name',
                    'label' => 'Name',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 1,
                    'required' => true,
                    'livewire' => true,
                    'value' => $name
                ])
                @include('global.partials..floating-label-input', [
                    'id' => 'url',
                    'name' => 'url',
                    'label' => 'Url',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 2,
                    'required' => true,
                    'livewire' => true,
                    'value' => $url
                ])
                <button type="submit" class="btn btn-edit">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/sync.svg') }}"  alt="{{ __('alt.sync') }}" title="{{ __('alt.sync') }}"/>
                </button>
            </form>
        </div>
    @endif

    <!-- List of Testobjects -->
    @foreach ($testobjects as $testObj)
        <div class="border px-3 mb-4 pb-3 rounded border-primary-dark dark:border-primary-light">
            <p><strong>Name:</strong> {{ $testObj->name }}</p>
            <p><strong>URL:</strong> {{ $testObj->url }}</p>

            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
                <button class="btn btn-delete" id="{{ $testObj->id }}" wire:click="deleteObject($event.target.id)" wire:confirm="Are you sure?">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/trash.svg') }}"  alt="{{ __('alt.delete') }}" title="{{ __('alt.delete') }}"/>
                </button>
                <button class="btn btn-edit" id="{{ $testObj->id }}" wire:click="editObject($event.target.id)">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/sync.svg') }}"  alt="{{ __('alt.sync') }}" title="{{ __('alt.sync') }}"/>
                </button>
                <a alt="{{ __('alt.view') }}" title="{{ __('alt.view') }}" class="btn btn-details" wire:navigate.hover href="{{url(Config::get('app.locale') . "/tester/testobject/{$testObj->id}")}}">
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
