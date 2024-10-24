<script type="text/tmpl" id="trip-details-template">
  <% console.log(trip) %>
  <% if (trip.trip.hasOwnProperty("remarks")) { %>
    <div class="remarks">
      <h3>Remarks:</h3>
      <ul>
        <% for (let i = 0; i < trip.trip.remarks.length; i++) { %>
          <li class="<%= trip.trip.remarks[i].type %>" data-text="<%= trip.trip.remarks[i].type %>"><%= trip.trip.remarks[i].summary %></li>
        <% } %>
      </ul>
    </div>
  <% } %>

  <% if (trip.trip.currentLocation && false) { %>
    <div class="location-map" id="<%= unique %>" style="height: 300px; width: 100%;"></div>
  <% } %>

  <button data-stops="<%= JSON.stringify(trip.trip.stopovers) %>" class="stops-timeline-modal-button w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
  Stops</button>
</script>
