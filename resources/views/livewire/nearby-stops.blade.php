<div>
    @if ($locationInitialized)
        <div class=" mb-4">
            <div class="grid grid-cols-1">
                <p class="text-sm mb-0">Lat: {{ $latitude }} Lon: {{ $longitude }}</p>
            </div>
        </div>

        <div class=" mb-4">
            <input type="text" wire:model.change="search" class="w-full rounded-lg" placeholder="Search for a stop" />
        </div>
    @else
        <div role="status" class="max-w-full mb-4 pt-3 animate-pulse" wire.loading.remove wire.target="locationUpdated" >
            <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-2"></div>
            <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700"></div>
        </div>
    @endif

    @error('api')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @php
        $this->stops;
    @endphp

    <div class="mb-4">
        @if (!$stopsEmpty)
            @foreach ($this->stops as $stop)
                <div class="grid grid-cols-5 gap-2">
                    <div class="col-span-3">
                        <p class="text-lg m-0">{{ $stop->name }}</p>
                        <p class="text-sm text-gray-500">Distance: {{ $stop->distance }} m</p>
                    </div>
                    <button class="text-center align-middle my-auto justify-center h-fit py-2 bg-gray-300 rounded-full font-medium hover:bg-gray-400" wire:click="trips({{$stop->id}})">Trips</button>
                    <button class="text-center align-middle my-auto justify-center h-fit py-2 bg-gray-300 rounded-full font-medium hover:bg-gray-400" wire:click="details({{$stop->id}})">Info</button>
                </div>
                <hr />
            @endforeach
        @else
            @if ($locationInitialized)
                @if (!empty($stopsError))
                    <p>{{$stopsError}}</p>
                @else
                    <p>No stops found</p>
                @endif
            @else
                <div role="status" class="max-w-full mb-4 pt-3 animate-pulse" wire.loading.remove wire.target="locationUpdated" >
                    <div class="h-4 bg-gray-200 rounded-full dark:bg-gray-700 mb-4"></div>
                    <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-3"></div>
                    <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-5"></div>
                    <div class="h-4 bg-gray-200 rounded-full dark:bg-gray-700 mb-4"></div>
                    <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-3"></div>
                    <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-3"></div>
                </div>
            @endif
        @endif
    </div>
</div>
