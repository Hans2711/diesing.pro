<div>
    <button wire:click="addPortfolio" class="btn" id="add-note">
        <img class="w-6 h-5 invert" src="{{ Vite::asset('resources/icons/add.svg') }}" alt="{{ __('alt.add') }}" />
    </button>

    @if (!$activePortfolio)
        @foreach ($portfolios as $portfolio)
            <div class="border mt-3 p-3 rounded border-primary-dark dark:border-primary-light">
                <span>{{ $portfolio->name }}</span>
                <div class="grid md:grid-cols-2 gap-5 mt-2">
                    <button wire:click="deletePortfolio({{ $portfolio->id }})" wire:confirm="{{ __('text.are-you-sure') }}" class="btn-delete" id="delete-redirect" data-id="{{ $portfolio->id }}">
                        <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/close.svg') }}" alt="{{ __('alt.close') }}" />
                    </button>
                    <button wire:click="editPortfolio({{ $portfolio->id }})" id="{{ $portfolio->id }}" class="btn btn-edit">
                        <img class="w-10 h-5 invert" src="{{ Vite::asset('resources/icons/pencil-outline.svg') }}" alt="{{ __('alt.edit') }}" />
                    </button>
                </div>
            </div>
        @endforeach
    @else
    <div class="mt-3">
        <a alt="{{ __('text.back') }}" wire:click="cancelEdit" class="flex gap-2 mb-4 align-center hover:cursor-pointer btn-back">
            <img class="w-4 dark:invert" src="{{ Vite::asset('resources/icons/chevron-back.svg') }}" alt="{{ __('alt.back') }}" />
            <span class="leading-none">
                {{__('text.back')}}
            </span>
        </a>
        <h2 class="mb-3">Edit Portfolio ({{ $activePortfolio->name }})</h2>

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

            @if ($activePortfolio->media->count() > 0)
                <div class="my-3 flex flex-wrap gap-3">
                    @foreach ($activePortfolio->media as $photo)
                        <div class="">
                            <img class="w-24 h-24 object-cover rounded border" src="{{ Storage::url($photo->path) }}" alt="{{ $photo->name ?? '' }}">
                            <button class="btn mt-3 w-full btn-delete" id="{{ $photo->id }}" wire:click="deleteMedia($event.target.id)" wire:confirm="Are you sure?">{{ __('text.delete') }}</button>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mb-3">
                <input type="file" wire:model="media" multiple>
                @error('media.*') <span class="error">{{ $message }}</span> @enderror

                @if ($media)
                    <div class="my-3 flex flex-wrap gap-3">
                    @foreach ($media as $photo)
                        @if (in_array($photo->getMimeType(), ['image/jpeg', 'image/png', 'image/gif']))
                            <img class="w-24 h-24 object-cover rounded border" src="{{ $photo->temporaryUrl() }}" alt="{{ __('alt.view') }}">
                        @endif
                    @endforeach
                    </div>
                @endif
            </div>

            <div wire:ignore>
                <div id="editor" class="border rounded mb-3">{!! $description !!}</div>
            </div>
            <input type="text" class="hidden" id="description" name="description" wire:model="description" value="{{ htmlspecialchars($description, ENT_QUOTES, 'UTF-8') }}" />

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
        if (!window.quill) {
            window.quill = new window.Quill('#editor', options);
        }

        quill.on('text-change', (delta, oldDelta, source) => {
          if (source == 'user') {
            console.log('A user action triggered this change.');
            console.log(quill.getSemanticHTML());

            Livewire.dispatch('desc-changed', { content: quill.getSemanticHTML() });
          }
        });
    } else {
        window.quill = null;
    }
})
</script>
@endscript
