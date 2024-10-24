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
      <span class="plannedWhen <%= trips[i].when ? 'crossed' : '' %>" data-timestamp="<%= trips[i].plannedWhen %>"></span>
      <% if (trips[i].when) { %>
        <span class="when" data-timestamp="<%= trips[i].when %>"></span>
      <% } %>
    </div>
  <% } %>
</script>
