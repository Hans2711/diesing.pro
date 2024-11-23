<div>
    <div class="stop-modal-wrapper @if ($hidden)hidden @endif relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="stop-modal-background fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full mb-8 items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="stop-wrapper p-4 relative transform overflow-hidden rounded-lg bg-white text-left transition-all sm:w-full sm:max-w-lg">
                            <div class="relative right-0" wire:click="close()" >
                                <svg class="h-8 float-right" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 5.29289C5.68342 4.90237 6.31658 4.90237 6.70711 5.29289L12 10.5858L17.2929 5.29289C17.6834 4.90237 18.3166 4.90237 18.7071 5.29289C19.0976 5.68342 19.0976 6.31658 18.7071 6.70711L13.4142 12L18.7071 17.2929C19.0976 17.6834 19.0976 18.3166 18.7071 18.7071C18.3166 19.0976 17.6834 19.0976 17.2929 18.7071L12 13.4142L6.70711 18.7071C6.31658 19.0976 5.68342 19.0976 5.29289 18.7071C4.90237 18.3166 4.90237 17.6834 5.29289 17.2929L10.5858 12L5.29289 6.70711C4.90237 6.31658 4.90237 5.68342 5.29289 5.29289Z" fill="#0F1729"/>
                                </svg>
                            </div>
                            @if (isset($this->stop))
                                <p class="text-2xl pt-0 mt-0"><strong>{{$this->stop->name}}</strong></p>
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
