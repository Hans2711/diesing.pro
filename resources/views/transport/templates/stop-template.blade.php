<script type="text/tmpl" id="stop-template">
    <div class="station"
        data-id="<%= station && station.id !== undefined ? station.id : stops.id %>"
        data-lat="<%= station && station.location && station.location.latitude !== undefined ? station.location.latitude : stops.location.latitude %>"
        data-lon="<%= station && station.location && station.location.longitude !== undefined ? station.location.longitude : stops.location.longitude %>"
    >
        <p class="text-xl font-semibold">
            <%= station && station.name !== undefined ? station.name : stops.name %>
        </p>

        <div class="flex-1">
            <form method="POST" action="/" id="trips" class="trips bg-white p-3 rounded-lg shadow-md">
                <input type="hidden" name="_token" value="<%= csrfToken %>">

                <div class="mb-1">
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="departures">Departures</option>
                        <option value="arrivals">Arrivals</option>
                    </select>
                </div>

                <button id="options-dropdown-button" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 my-3" type="button">
                Options
                </button>

                <!-- Options -->
                <div class="space-y-4 z-20 hidden" id="options-dropdown">

                    <!-- When -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">When</label>
                        <input type="datetime-local" name="when" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Duration -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                        <input type="number" name="duration" value="10" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Results -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Results</label>
                        <input type="number" name="results" min="1" placeholder="Number of results" value="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Transportation Options -->
                    <fieldset class="mt-4">
                        <legend class="text-sm font-medium text-gray-700">Transportation Options</legend>
                        <div class="mt-2 space-y-2">
                            <% transportOptions.forEach(function(option) { %>
                                <div class="flex items-center">
                                    <input type="checkbox" name="<%= option %>" id="<%= option %>_arrival" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="<%= option %>_arrival" class="ml-2 block text-sm text-gray-700 capitalize">
                                        <%= option.replace('_', ' ') %>
                                    </label>
                                </div>
                            <% }); %>
                        </div>
                    </fieldset>

                    <input type="hidden" name="linesOfStops" value="1">

                    <!-- Submit Button -->
                </div>
                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
                    Fetch
                </button>
            </form>

            <div class="trips-wrapper mt-4">
                <!-- Display arrival data here -->
            </div>

            <!-- Map -->
            <div class="mt-8">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</script>
