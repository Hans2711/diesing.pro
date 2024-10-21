<script type="text/tmpl" id="trips-template">
  <% for (let i = 0; i < arrivals.length; i++) { %>
    <div class="trip">
      <p><%= arrivals[i].line.name %></p>
      <p><%= arrivals[i].provenance %></p>
      <p><%= arrivals[i].plannedWhen %></p>
    </div>
  <% } %>
</script>
