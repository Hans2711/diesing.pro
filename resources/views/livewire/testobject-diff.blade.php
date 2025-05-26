<div>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
        <div>
            <label for="instanceOne" class="block text-sm font-medium">{{ __('text.instance-one') }}</label>
            <select id="instanceOne" wire:model="instanceOne" class="mt-1 block w-full rounded dark:bg-secondary-light">
                @for ($i = 0; $i < $instanceCount; $i++)
                    <option value="{{ $i }}">{{ $i + 1 }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label for="instanceTwo" class="block text-sm font-medium">{{ __('text.instance-two') }}</label>
            <select id="instanceTwo" wire:model="instanceTwo" class="mt-1 block w-full rounded dark:bg-secondary-light">
                @for ($i = 0; $i < $instanceCount; $i++)
                    <option value="{{ $i }}">{{ $i + 1 }}</option>
                @endfor
            </select>
        </div>
        <div>
            <label for="renderName" class="block text-sm font-medium">Render Name</label>
            <select id="renderName" wire:model="renderName" class="mt-1 block w-full rounded dark:bg-secondary-light">
                <option value="Inline">Inline</option>
                <option value="Combined">Combined</option>
                <option value="JsonHtml">JsonHtml</option>
                <option value="SideBySide">SideBySide</option>
            </select>
        </div>
        <div>
            <label for="detailLevel" class="block text-sm font-medium">Detail Level</label>
            <select id="detailLevel" wire:model="detailLevel" class="mt-1 block w-full rounded dark:bg-secondary-light">
                <option value="line">Line</option>
                <option value="word">Word</option>
                <option value="char">Char</option>
            </select>
        </div>
    </div>
    {!! $diff !!}
</div>
