<div>
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label for="instanceIndex" class="block text-sm font-medium">{{ __('text.testinstance') }}</label>
            <select id="instanceIndex" wire:model="instanceIndex" class="mt-1 block w-full rounded dark:bg-secondary-light">
                @for ($i = 0; $i < $instanceCount; $i++)
                    <option value="{{ $i }}">{{ $i + 1 }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label for="searchTerm" class="block text-sm font-medium">{{ __('text.search') }}</label>
            <input type="text" id="searchTerm" wire:model.change="searchTerm" class="mt-1 block w-full rounded dark:bg-secondary-light" />
        </div>
    </div>
    @foreach ($results as $data)
        <div class="border p-3 mb-4 rounded border-primary-dark dark:border-primary-light">
            <h3>{{ $data['run']->name }}</h3>
            <p class="break-all">{!! $data['snippet'] !!}</p>
        </div>
    @endforeach
</div>
