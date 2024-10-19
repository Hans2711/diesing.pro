<script type="text/tmpl" id="stops-list-template">
  <% for (let i = 0; i < stops.length; ++i) { %>
    <div class="stop p-4 border rounded"
        data-type="<%- stops[i].type %>"
        data-id="<%- stops[i].id %>"
        data-name="<%- stops[i].name %>"
        data-location='<%- JSON.stringify(stops[i].location) %>'
        data-products='<%- stops[i].products ? JSON.stringify(stops[i].products) : "[]" %>'
    >
        <p class="name"><%- stops[i].name %></p>
        <% if (stops[i].products) { %>
            <div class="products">
                <% for (let key in stops[i].products) { %>
                    <% if (stops[i].products[key]) { %>
                        <p data-type="<%- key %>"><%- key %></p>
                    <% } %>
                <% } %>
            </div>
        <% } %>
    </div>
  <% } %>
</script>
