<script type="text/tmpl" id="trips-template">
  <% for (let i = 0; i < trips.length; i++) { %>
    <div class="trip"
      data-id="<%= trips[i].tripId %>"
      data-prognosisType="<%= trips[i].prognosisType %>"
      data-lineProduct ="<%= trips[i].line.product %>"
      data-status="<%= trips[i].remarks && trips[i].remarks.length > 0 && trips[i].remarks[0].code %>"
      data-trip='<%= JSON.stringify(trips[i]) %>'
    >
      <p class="trip-title"><%= trips[i].line.name %></p>
      <% if (type == 'arrivals') { %>
        <span class="provenance"><%= trips[i].provenance %></span>
      <% } else { %>
        <span class="direction"><%= trips[i].direction %></span>
      <% } %>

      <!-- Add data-timestamp attributes and conditional 'crossed' class -->
      <span class="plannedWhen <%= trips[i].when && trips[i].when !== trips[i].plannedWhen ? 'crossed' : '' %>" data-timestamp="<%= trips[i].plannedWhen %>"></span>
      <% if (trips[i].when && trips[i].plannedWhen !=  trips[i].when) { %>
        <span class="when" data-timestamp="<%= trips[i].when %>"></span>
      <% } %>


      <button class="trip-details-button w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-4">
      Details</button>
      <div class="trip-details-wrapper pt-2"></div>

    </div>
  <% } %>
</script>
