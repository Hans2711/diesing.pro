<div>
    <div class="stop-modal-wrapper @if ($hidden)hidden @endif relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="stop-modal-background fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="stop-wrapper p-4 relative transform overflow-hidden rounded-lg bg-white text-left transition-all sm:w-full sm:max-w-lg">
                            @if (isset($this->stop))
                                <h1>{{$this->stop->name}}</h1>
                                <div class="grid grid-cols-10 gap-4 mb-3">
                                    @foreach ($this->stop->products as $type => $enabled)
                                        @if ($enabled)
                                            <div class="col-span-1 flex flex-col items-center">
                                                <!----
                                                <span class="text-xs">{{ $type }}</span>
                                                ---->
                                                <img class="w-10" src="{{ Vite::asset("resources/images/transport_products/{$type}.png") }}" />
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div id="map" data-longitude="{{ $this->stop->location->longitude}}" data-latitude="{{ $this->stop->location->latitude }}" style="height: 400px; width: 100%;"></div>
                            @endif
                        </div>
                        <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" wire:click="close()" class=" close-button mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
