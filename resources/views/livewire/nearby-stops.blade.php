<div>
    <div class="mb-4">
        @if (is_array($this->stops) && count($this->stops) > 0)
            @foreach ($this->stops as $stop)
                <div class="grid grid-cols-5 gap-2">
                    <div class="col-span-3">
                        <p class="text-lg m-0">{{ $stop->name }}</p>
                        <p class="text-sm text-gray-500">Distance: {{ $stop->distance }} mins</p>
                    </div>
                    <button class="text-center align-middle my-auto justify-center h-fit py-2 bg-gray-300 rounded-full font-medium hover:bg-gray-400" wire:click="trips({{$stop->id}})">Trips</button>
                    <button class="text-center align-middle my-auto justify-center h-fit py-2 bg-gray-300 rounded-full font-medium hover:bg-gray-400" wire:click="details({{$stop->id}})">Info</button>
                </div>
                <hr />
            @endforeach
        @else
            <div role="status" class="max-w-sm mb-4 pt-3 animate-pulse" wire.loading.remove wire.target="locationUpdated" >
                <div class="h-4 bg-gray-200 rounded-full dark:bg-gray-700 mb-4"></div>
                <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-3"></div>
                <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-5"></div>
                <div class="h-4 bg-gray-200 rounded-full dark:bg-gray-700 mb-4"></div>
                <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-3"></div>
                <div class="h-3 bg-gray-200 rounded-full dark:bg-gray-700 mb-3"></div>
            </div>
        @endif
    </div>
</div>
