<div>
    @vite(['resources/css/diff-table.css'])

    <a alt="{{ __('text.back') }}" wire:navigate.hover href="{{url(Config::get('app.locale') . "/tester/testobject/{$testrun->testobject->id}")}}" class="flex gap-2 mb-4 align-center btn-back dark:text-secondary-dark dark:invert">
        <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}" alt="{{ __('alt.back') }}" />
        <span class="leading-none">
            {{__('text.back')}}
        </span>
    </a>

    @if (!empty($diffInstanceOne) || !empty($diffInstanceOne))
        <div class="border px-3 rounded border-primary-dark dark:border-primary-light">
            @if (!empty($diffInstanceOne))
                <p><strong>{{ __('text.instance-one') }}:</strong> {{ $diffInstanceOne->created_at_clean}}</p>
            @endif
            @if (!empty($diffInstanceTwo))
                <p><strong>{{ __('text.instance-two') }}:</strong> {{ $diffInstanceTwo->created_at_clean}}</p>

                <form wire:submit="diff">
                    <div class="flex gap-4 mb-3">
                        <div class="flex-1">
                            <label for="renderName" class="block text-sm font-medium">Render Name</label>
                            <select wire:model.change="renderName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-secondary-light">
                                <option value="Inline">Inline</option>
                                <option value="Combined">Combined</option>
                                <option value="JsonHtml">JsonHtml</option>
                                <option value="SideBySide">SideBySide</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label for="detailLevel" class="block text-sm font-medium">Detail Level</label>
                            <select wire:model.change="detailLevel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-secondary-light">
                                <option value="line">Line</option>
                                <option value="word">Word</option>
                                <option value="char">Char</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-cols-2 grid align-middle gap-5 mb-3">
                        <button type="submit" class="btn">
                            <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/git-compare.svg') }}" alt="{{ __('alt.compare') }}" />
                        </button>
                    </div>
                </form>
            @endif
        </div>

        {!! isset($diffContent) ? $diffContent : '' !!}
        <br />
        @if (session()->has('diff'))
            <div class="alert alert-success mb-5">{{ session('diff') }}</div>
        @endif
    @endif


    @include('global.partials..floating-label-input', [
        'id' => 'name',
        'name' => 'name',
        'label' => 'Name',
        'wrapperClass' => 'w-full sm:w-auto mb-4',
        'tabindex' => 1,
        'additional' => 'wire:change="updateName($event.target.value)"',
        'value' => $testrun->name
    ])

    <button class="btn mb-3" wire:click="createInstance" wire:loading.attr="disabled" wire:target="createInstance">
        <img wire:loading.remove wire:target="createInstance" class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" alt="{{ __('alt.add') }}" />
        <img wire:loading wire:target="createInstance" class="w-4 h-4 invert animate-spin" src="{{ Vite::asset('resources/icons/sync.svg') }}" alt="{{ __('alt.sync') }}" />
    </button>

    @foreach ($testrun->testinstances as $testinstance)
        <div class="border px-3 mb-4 pb-3 rounded border-primary-dark dark:border-primary-light">
            <p><strong>Name:</strong> {{ $testinstance->created_at_clean}}</p>
            <p><strong>Status:</strong> {{ empty($testinstance->html) ? __('text.empty') : __('text.filled')}}</p>

            <div class="grid grid-cols-3 sm:grid-cols-5 gap-3 align-middle">
                <button class="btn btn-delete" wire:click="deleteInstance({{$testinstance->id}})" wire:confirm="Are you sure?">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/trash.svg') }}" alt="{{ __('alt.delete') }}" />
                </button>
                <a alt="{{ __('alt.view') }}" class="btn btn-details" wire:navigate.hover href="{{url(Config::get('app.locale') . "/tester/testinstance/{$testinstance->id}")}}" >
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/eye.svg') }}" alt="{{ __('alt.view') }}" />
                </a>
                <button class="btn btn-fetch" wire:navigate wire:click="fetchInstance({{$testinstance->id}})"")}}" >
                    <img
                        class="w-20 h-5 invert"
                        src="{{ Vite::asset('resources/icons/' . (empty($testinstance->html) ? 'download.svg' : 'arrow-down.svg')) }}"
                        alt="{{ __('alt.download') }}"
                    />
                </button>
                <button class="btn btn-diff" wire:click="addToDiff({{$testinstance->id}})">
                    <img class="w-20 h-5 invert" src="{{ Vite::asset('resources/icons/git-compare.svg') }}" alt="{{ __('alt.compare') }}" />
                </button>
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
