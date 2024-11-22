<div>
    @vite(['resources/js/transport.js'])

    @if ($latitude && $longitude)
        <div class=" mb-4">
            <div class="grid grid-cols-1">
                <p class="text-sm mb-0">Lat: {{ $latitude }} Lon: {{ $longitude }}</p>
            </div>
            <p class="text-sm">{{ $address }}</p>
        </div>
    @else
        <div role="status" class="max-w-sm mb-4 pt-3 animate-pulse" wire.loading.remove wire.target="locationUpdated" >
            <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-2"></div>
            <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700"></div>
        </div>
    @endif

    @error('location')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror


    <livewire:nearby-stops :latitude="$latitude" :longitude="$longitude" :address="$address" />

</div>
