<div>
    <button wire:click="addPortfolio" class="ml-2 p-2 py-2.5 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 flex items-center" id="add-note">
        <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" />
    </button>

    @if (!$activePortfolio)
        @foreach ($portfolios as $portfolio)
            <div class="border mt-3 p-3 rounded">
                <span>{{ $portfolio->name }}</span>
                <div class="grid grid-cols-2 gap-3 mt-2">
                    <button wire:click="deletePortfolio({{ $portfolio->id }})" wire:confirm="{{ __('text.are-you-sure') }}" class="justify-center w-full p-2 py-2.5 px-4 bg-red-500 text-white rounded hover:bg-red-700 flex items-center delete-redirect" id="delete-redirect" data-id="{{ $portfolio->id }}">
                        <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" />
                    </button>
                    <button wire:click="editPortfolio({{ $portfolio->id }})" id="{{ $portfolio->id }}" class="justify-center w-full p-2 py-2.5 px-4 bg-green-500 text-white rounded hover:bg-green-700 flex items-center edit-redirect">
                        <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/pencil-outline.svg') }}" />
                    </button>
                </div>
            </div>
        @endforeach
    @else
    <div class="mt-3 ml-3">
        <a wire:click="cancelEdit" class="flex gap-2 mb-4 align-center hover:cursor-pointer">
            <img class="w-4" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}" />
            <span class="leading-none">
                {{__('text.back')}}
            </span>
        </a>
        <h3 class="mb-3">Edit Portfolio ({{ $activePortfolio->name }})</h3>

        <form wire:submit.prevent="edit">
            @include('global.partials.floating-label-input', [
                'id' => 'name',
                'name' => 'name',
                'label' => 'Name',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'tabindex' => 1,
                'required' => true,
                'additional' => 'wire:model="name"'
            ])

            @include('global.partials.floating-label-input', [
                'id' => 'url',
                'name' => 'url',
                'label' => 'Url',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'tabindex' => 1,
                'additional' => 'wire:model="url"'
            ])

            <div id="editor" class="border rounded mb-3">{!! $description !!}</div>
            <input type="text" class="hidden" id="description" name="description" wire:model="description" />

            <button id="submit" class="btn mt-3">{{ __('text.save') }}</button>
        </form>
    </div>
    @endif

    <div class="mt-3">
        @if (session()->has('status'))
            <div wire:transition.fade>
                <div class="alert alert-success">{{ session('status') }}</div>
            </div>
        @endif
    </div>
</div>

@script
<script>
Livewire.hook('morphed',  (componet) => {
    if (document.querySelector("#editor")) {
        const options = {
            modules: {
                toolbar: true,
            },
            placeholder: 'Description',
            theme: 'snow'
        };
        const quill = new window.Quill('#editor', options);
        var description = document.querySelector('input[name=description]');

        quill.on('text-change', (delta, oldDelta, source) => {
          if (source == 'user') {
            console.log('A user action triggered this change.');
            console.log(quill.getSemanticHTML());
            description.value = quill.getSemanticHTML();
          }
        });
    }
})
</script>
@endscript
