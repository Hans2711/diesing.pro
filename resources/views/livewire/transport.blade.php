<div>
    @vite(['resources/js/transport.js'])

    @error('location')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <livewire:nearby-stops :latitude="$latitude" :longitude="$longitude" />

    <div class="fixed z-50 @if ($hideStatus) hidden @endif bottom-0 left-0 w-screen h-8 bg-gray-500" >
        <div class="container mx-auto md:px-0 px-6">
            <div class="align-middle text-white">
                <p wire:stream="status" class="text-sm" >Status</p>
            </div>
        </div>
    </div>
</div>
