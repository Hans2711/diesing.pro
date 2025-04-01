<div>
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
        'id' => 'birthday',
        'name' => 'birthday',
        'label' => 'Birthday',
        'wrapperClass' => 'w-full sm:w-auto mb-3',
        'tabindex' => 2,
        'required' => true,
        'additional' => 'wire:model="birthday"'
    ])
    @include('global.partials.floating-label-input', [
        'id' => 'nationality',
        'name' => 'nationality',
        'label' => 'Nationality',
        'wrapperClass' => 'w-full sm:w-auto mb-3',
        'tabindex' => 3,
        'required' => true,
        'additional' => 'wire:model="nationality"'
    ])
    @include('global.partials.floating-label-input', [
        'id' => 'address',
        'name' => 'address',
        'label' => 'Address',
        'wrapperClass' => 'w-full sm:w-auto mb-3',
        'tabindex' => 4,
        'required' => true,
        'additional' => 'wire:model="address"'
    ])
    @include('global.partials.floating-label-input', [
        'id' => 'phone',
        'name' => 'phone',
        'label' => 'Phone',
        'wrapperClass' => 'w-full sm:w-auto mb-3',
        'tabindex' => 5,
        'required' => true,
        'additional' => 'wire:model="phone"'
    ])
    @include('global.partials.floating-label-input', [
        'id' => 'email',
        'name' => 'email',
        'label' => 'Email',
        'wrapperClass' => 'w-full sm:w-auto mb-3',
        'tabindex' => 6,
        'required' => true,
        'additional' => 'wire:model="email"'
    ])
    @include('global.partials.floating-label-input', [
        'id' => 'parents',
        'name' => 'parents',
        'label' => 'Parents',
        'wrapperClass' => 'w-full sm:w-auto mb-3',
        'tabindex' => 7,
        'required' => true,
        'additional' => 'wire:model="parents"'
    ])
    @include('global.partials.floating-label-input', [
        'id' => 'siblings',
        'name' => 'siblings',
        'label' => 'Siblings',
        'wrapperClass' => 'w-full sm:w-auto mb-3',
        'tabindex' => 8,
        'required' => true,
        'additional' => 'wire:model="siblings"'
    ])

    <div class="mt-5">
        <h3>Lists</h3>
        @foreach($lists as $index => $list)
        <div class="mb-4 mt-4">
            @include('global.partials.floating-label-input', [
                'id' => "title_{$index}",
                'name' => "title_{$index}",
                'label' => 'Title',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'tabindex' => $index + 1,
                'required' => true,
                'additional' => "wire:model='lists.{$index}.title'"
            ])
            @include('global.partials.floating-label-input', [
                'id' => "content_{$index}",
                'name' => "content_{$index}",
                'label' => 'Content',
                'wrapperClass' => 'w-full sm:w-auto mb-3',
                'tabindex' => $index + 2,
                'required' => true,
                'additional' => "wire:model='lists.{$index}.content'"
            ])
            <button type="button" class="btn btn-delete" wire:click="removeList({{ $index }})">Remove</button>
        </div>
        @endforeach

        <button type="button" class="btn mb-4" wire:click="addList">Add List</button>
    </div>

    <button class="btn" wire:click="save" >Save</button>
    <div class="mt-3">
        @if (session()->has('status'))
            <div wire:transition.fade>
                <div class="alert alert-success">{{ session('status') }}</div>
            </div>
        @endif
    </div>
</div>
