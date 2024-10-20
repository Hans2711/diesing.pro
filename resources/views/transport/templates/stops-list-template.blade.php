<script type="text/tmpl" id="stops-list-template">
    <% function getDeepestStation(station) {
        while (station && station.station) {
            station = station.station;
        }
        return station;
    } %>
    <% var displayedStops = []; %>
    <% for (let i = 0; i < stops.length; ++i) { %>
        <% for (let j = 0; j < stops[i].stations.length; ++j) { %>
            <% var station = getDeepestStation(stops[i].stations[j].station); %>

            <% if (!station) { continue; } %>
            <% if (displayedStops.includes(station.id)) { continue; } %>
            <% displayedStops.push(station.id); %>

            <% if (!station.products) { continue; } %>

            <div class="stop p-4 border rounded"
                data-type="<%- station.type %>"
                data-id="<%- station.id %>"
                data-name="<%- station.name %>"
                data-location="<%- JSON.stringify(station.location) %>"
                data-products="<%- JSON.stringify(station.products) %>"
                data-reachable-in="<% stops[i].duration %>"
            >
                <p class="type"><%- station.name %> </p>
                <p><%- stops[i].duration %> Minutes away </p>
                <div class="products">
                    <% for (let key in station.products) { %>
                        <% if (station.products[key]) { %>
                          <p data-type="<%- key %>"><%- key %></p>
                        <% } %>
                    <% } %>
                </div>
            </div>
        <% } %>
    <% } %>
</script>
