<div>
    <!-- New Testobject Form -->
    @if (!$testobject)
        <div class="border border-black px-3 pb-3 mb-4">
            <h2>New Testobject</h2>

            <form wire:submit.prevent="createObject">
                @include('private.modals.parts.floating-label-input', [
                    'id' => 'name',
                    'name' => 'name',
                    'label' => 'Name',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 1,
                    'required' => true,
                    'livewire' => true
                ])
                @include('private.modals.parts.floating-label-input', [
                    'id' => 'url',
                    'name' => 'url',
                    'label' => 'Url',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 2,
                    'required' => true,
                    'livewire' => true
                ])
                <button type="submit" class="btn mb-3">Add</button>
            </form>
        </div>
    @endif

    <!-- Update Testobject Form -->
    @if ($testobject)
        <div class="border border-black px-3 pb-3 mb-4">
            <h2>Update {{ $testobject->name }}</h2>

            <form wire:submit.prevent="updateObject">
                @include('private.modals.parts.floating-label-input', [
                    'id' => 'name',
                    'name' => 'name',
                    'label' => 'Name',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 1,
                    'required' => true,
                    'livewire' => true,
                    'value' => $name
                ])
                @include('private.modals.parts.floating-label-input', [
                    'id' => 'url',
                    'name' => 'url',
                    'label' => 'Url',
                    'wrapperClass' => 'w-full sm:w-auto mb-4',
                    'tabindex' => 2,
                    'required' => true,
                    'livewire' => true,
                    'value' => $url
                ])
                <button type="submit" class="btn mb-3">Update</button>
            </form>
        </div>
    @endif

    <!-- List of Testobjects -->
    @foreach ($testobjects as $testObj)
        <div class="border border-gray-200 px-3 mb-4">
            <p><strong>Name:</strong> {{ $testObj->name }}</p>
            <p><strong>URL:</strong> {{ $testObj->url }}</p>

            <button class="btn mb-3" wire:click="deleteObject({{ $testObj->id }})">Delete</button>
            <button class="btn mb-3" wire:click="editObject({{ $testObj->id }})">Edit</button>
            <a class="btn mb-3" href="{{url("tester/testobject/{$testObj->id}")}}">Details</a>
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
