import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
  apiKey: window.MAPS_API_KEY,
  version: "weekly",
});

export function createMap(lat, lng) {
  loader.load().then(async () => {
    const { Map } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

    const map = new Map(document.getElementById("map"), {
      center: { lat: parseFloat(lat), lng: parseFloat(lng) },
      zoom: 18,
      mapId: "singleStopMap",
    });

    const marker = new AdvancedMarkerElement({
      map,
      position: { lat: parseFloat(lat), lng: parseFloat(lng) },
      title: "Thing",
      gmpClickable: true,
    });
  });
}
