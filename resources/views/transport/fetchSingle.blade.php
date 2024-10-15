<div class="station"
    data-id="{{ isset($station['id']) ? $station['id'] : $stops['id'] }}"
    data-lat="{{ isset($station['location']['latitude']) ? $station['location']['latitude'] : $stops['location']['latitude'] }}"
    data-lon="{{ isset($station['location']['longitude']) ? $station['location']['longitude'] : $stops['location']['longitude'] }}"
>
    <p class="text-xl font-semibold">{{ isset($station['name']) ? $station['name'] : $stops['name'] }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
        <!-- Arrivals Form -->
        <div class="arrivals flex-1">
            <form method="POST" action="/arrivals" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <h2 class="text-lg font-medium mb-4">Arrival Options</h2>

                <!-- Options -->
                <div class="space-y-4">
                    <!-- When -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">When</label>
                        <input type="datetime-local" name="when" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Direction -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Direction</label>
                        <input type="text" name="direction" placeholder="Enter direction" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                        <input type="number" name="duration" value="10" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Results -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Results</label>
                        <input type="number" name="results" min="1" placeholder="Number of results" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Lines of Stops -->
                    <div class="flex items-center">
                        <input type="checkbox" name="linesOfStops" id="linesOfStops_arrival" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="linesOfStops_arrival" class="ml-2 block text-sm text-gray-700">Lines of Stops</label>
                    </div>

                    <!-- Remarks -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remarks" id="remarks_arrival" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remarks_arrival" class="ml-2 block text-sm text-gray-700">Remarks</label>
                    </div>

                    <!-- Transportation Options -->
                    <fieldset class="mt-4">
                        <legend class="text-sm font-medium text-gray-700">Transportation Options</legend>
                        <div class="mt-2 space-y-2">
                            @php
                                $transportOptions = ['nationalExpress', 'national', 'regionalExp', 'regional', 'suburban', 'bus', 'ferry', 'subway', 'tram', 'taxi'];
                            @endphp
                            @foreach ($transportOptions as $option)
                                <div class="flex items-center">
                                    <input type="checkbox" name="{{ $option }}" id="{{ $option }}_arrival" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="{{ $option }}_arrival" class="ml-2 block text-sm text-gray-700 capitalize">{{ str_replace('_', ' ', $option) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>

                    <!-- Pretty -->
                    <div class="flex items-center mt-2">
                        <input type="checkbox" name="pretty" id="pretty_arrival" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="pretty_arrival" class="ml-2 block text-sm text-gray-700">Pretty</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
                        Fetch Arrivals
                    </button>
                </div>
            </form>
            <div class="arrivals-wrapper mt-4">
                <!-- Display arrival data here -->
            </div>
        </div>

        <!-- Departures Form -->
        <div class="departures flex-1">
            <form method="POST" action="/departures" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                <h2 class="text-lg font-medium mb-4">Departure Options</h2>

                <!-- Options (Same as arrivals but with different IDs) -->
                <div class="space-y-4">
                    <!-- When -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">When</label>
                        <input type="datetime-local" name="when" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Direction -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Direction</label>
                        <input type="text" name="direction" placeholder="Enter direction" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                        <input type="number" name="duration" value="10" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Results -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Results</label>
                        <input type="number" name="results" min="1" placeholder="Number of results" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Lines of Stops -->
                    <div class="flex items-center">
                        <input type="checkbox" name="linesOfStops" id="linesOfStops_departure" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="linesOfStops_departure" class="ml-2 block text-sm text-gray-700">Lines of Stops</label>
                    </div>

                    <!-- Remarks -->
                    <div class="flex items-center">
                        <input type="checkbox" name="remarks" id="remarks_departure" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remarks_departure" class="ml-2 block text-sm text-gray-700">Remarks</label>
                    </div>

                    <!-- Transportation Options -->
                    <fieldset class="mt-4">
                        <legend class="text-sm font-medium text-gray-700">Transportation Options</legend>
                        <div class="mt-2 space-y-2">
                            @foreach ($transportOptions as $option)
                                <div class="flex items-center">
                                    <input type="checkbox" name="{{ $option }}" id="{{ $option }}_departure" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="{{ $option }}_departure" class="ml-2 block text-sm text-gray-700 capitalize">{{ str_replace('_', ' ', $option) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>

                    <!-- Pretty -->
                    <div class="flex items-center mt-2">
                        <input type="checkbox" name="pretty" id="pretty_departure" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="pretty_departure" class="ml-2 block text-sm text-gray-700">Pretty</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
                        Fetch Departures
                    </button>
                </div>
            </form>
            <div class="departures-wrapper mt-4">
                <!-- Display departure data here -->
            </div>
        </div>
    </div>

    <!-- Map -->
    <div class="mt-8">
        <div id="map" style="height: 400px; width: 100%;"></div>
    </div>
</div>

