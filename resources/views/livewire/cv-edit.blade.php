<div>
    <h3 class="mb-3">Dynamic Fields</h3>
    @foreach($fields as $index => $field)
        <div class="mb-4">
            @include('global.partials.floating-label-input', [
                'id' => "field_title_{$index}",
                'name' => "field_title_{$index}",
                'label' => 'Title',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'required' => true,
                'additional' => "wire:model='fields.{$index}.title'"
            ])
            @include('global.partials.floating-label-input', [
                'id' => "field_content_{$index}",
                'name' => "field_content_{$index}",
                'label' => 'Content',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'required' => true,
                'additional' => "wire:model='fields.{$index}.content'"
            ])
            <div class="flex gap-2 mt-2">
                <button type="button" class="btn" wire:click="moveFieldUp({{ $index }})" @if($index === 0) disabled @endif>↑</button>
                <button type="button" class="btn" wire:click="moveFieldDown({{ $index }})" @if($index === count($fields) - 1) disabled @endif>↓</button>
                <button type="button" class="btn btn-delete btn-sm" wire:click="removeField({{ $index }})">Remove</button>
            </div>
        </div>
    @endforeach
    <button type="button" class="btn" wire:click="addField">Add Field</button>

    <h3 class="mt-5 mb-3">Lists</h3>
    @foreach($lists as $listIndex => $list)
        <div class="mb-4 border p-3 border-primary-dark dark:border-primary-light rounded dark:text-white">
            <h4 class="mb-3">List {{ $listIndex + 1 }}</h4>
            @include('global.partials.floating-label-input', [
                'id' => "list_title_{$listIndex}",
                'name' => "list_title_{$listIndex}",
                'label' => 'List Title',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'required' => true,
                'additional' => "wire:model='lists.{$listIndex}.title'"
            ])

            @include('global.partials.floating-label-input', [
                'id' => "list_column_{$listIndex}",
                'name' => "list_column_{$listIndex}",
                'label' => 'List Columns',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'required' => true,
                'additional' => "wire:model='lists.{$listIndex}.column'",
                'type' => "number"
            ])

            @include('global.partials.floating-label-input', [
                'id' => "list_pagebreak_{$listIndex}",
                'name' => "list_pagebreak_{$listIndex}",
                'label' => 'List Page Break',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'required' => true,
                'additional' => "wire:model='lists.{$listIndex}.pagebreak'",
                'type' => "number"
            ])

            @foreach($list['items'] as $itemIndex => $item)
                <div class="mb-3">
                    @include('global.partials.floating-label-input', [
                        'id' => "list_item_title_{$listIndex}_{$itemIndex}",
                        'name' => "list_item_title_{$listIndex}_{$itemIndex}",
                        'label' => 'Item Title',
                        'wrapperClass' => 'w-full sm:w-auto mb-3',
                        'required' => true,
                        'additional' => "wire:model='lists.{$listIndex}.items.{$itemIndex}.title'"
                    ])
                    <div wire:ignore>
                        <div class="editor border rounded mb-3" wire:ignore>{!! $lists[$listIndex]['items'][$itemIndex]['content'] !!}</div>
                        <input type="text" class="hidden" value="{!! htmlspecialchars($lists[$listIndex]['items'][$itemIndex]['content'], ENT_QUOTES, 'UTF-8') !!}" wire:model.fill="lists.{{$listIndex}}.items.{{$itemIndex}}.content" />
                    </div>

                    <div class="flex gap-2 mt-2">
                        <button type="button" class="btn" wire:click="moveListItemUp({{ $listIndex }}, {{ $itemIndex }})" @if($itemIndex === 0) disabled @endif>↑</button>
                        <button type="button" class="btn" wire:click="moveListItemDown({{ $listIndex }}, {{ $itemIndex }})" @if($itemIndex === count($list['items']) - 1) disabled @endif>↓</button>
                        <button type="button" class="btn btn-delete btn-sm" wire:click="removeListItem({{ $listIndex }}, {{ $itemIndex }})">Remove Item</button>
                    </div>
                </div>
            @endforeach

            <div class="flex justify-start gap-3">
                <button type="button" class="btn btn-delete" wire:click="removeList({{ $listIndex }})">Remove List</button>
                <button type="button" class="btn" wire:click="addListItem({{ $listIndex }})">Add Item</button>
            </div>

            <div class="flex gap-2 mt-2">
                <button type="button" class="btn" wire:click="moveListUp({{ $listIndex }})" @if($listIndex === 0) disabled @endif>↑ Move List Up</button>
                <button type="button" class="btn" wire:click="moveListDown({{ $listIndex }})" @if($listIndex === count($lists) - 1) disabled @endif>↓ Move List Down</button>
            </div>
        </div>
    @endforeach

    <button type="button" class="btn" wire:click="addList">Add List</button>
    <button class="btn mt-4" wire:click="save">Save</button>

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
Livewire.hook('morphed', (component) => {
    console.log('Livewire component morphed, reinitializing editors');
    initEditors();
});

    initEditors();

function initEditors() {
    document.querySelectorAll(".editor").forEach((editorElement, index) => {
        const hiddenInput = editorElement.nextElementSibling; // Get corresponding hidden input
        console.log(`Initializing editor ${index}`, { editorElement, hiddenInput });

        if (!window.quills) {
            window.quills = [];
        }

        if (!window.quills[index]) {
            const options = {
                modules: { toolbar: true },
                placeholder: 'Content',
                theme: 'snow'
            };

            window.quills[index] = new window.Quill(editorElement, options);
            console.log(`Editor ${index} initialized`);

            // Ensure the content is set properly after initialization
            const initialContent = hiddenInput.value;
            if (initialContent) {
                window.quills[index].root.innerHTML = initialContent;
                console.log(`Editor ${index} content set to: `, initialContent);
            }

            // Update hidden input when Quill content changes
            window.quills[index].on('text-change', () => {
                hiddenInput.value = window.quills[index].root.innerHTML;
                console.log(`Editor ${index} content updated`, hiddenInput.value);

                // Notify Livewire that the content has changed
                Livewire.dispatch('content-updated', {
                    index: index,
                    content: hiddenInput.value
                });
            });
        }
    });
}
</script>
@endscript

