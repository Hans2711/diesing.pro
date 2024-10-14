document.addEventListener("DOMContentLoaded", function () {
  const options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0,
  };

  var selectedStop = null;

  function updateSelectedStop(id) {
    selectedStop = id;
    document.querySelectorAll(".stops-wrapper .stop").forEach(function (stop) {
      if (stop.dataset.id == id) {
        stop.classList.add("stop-selected");
      } else {
        if (stop.classList.contains("stop-selected")) {
          stop.classList.remove("stop-selected");
        }
      }
    });
  }

  function clickStop(e) {
    console.log("Stop clicked:", e.currentTarget);
    updateSelectedStop(e.currentTarget.dataset.id);
  }

  function applyClickStopListeners() {
    document.querySelectorAll(".stops-wrapper .stop").forEach(function (stop) {
      stop.removeEventListener("click", clickStop);
      stop.addEventListener("click", clickStop);
    });
  }

  function success(pos) {
    const crd = pos.coords;

    console.log("Your current position is:");
    console.log(`Latitude : ${crd.latitude}`);
    console.log(`Longitude: ${crd.longitude}`);
    console.log(`More or less ${crd.accuracy} meters.`);

    // Build URL with query parameters
    const url = new URL("/transport/fetch", window.location.origin);
    url.searchParams.append("lati", crd.latitude);
    url.searchParams.append("long", crd.longitude);
    url.searchParams.append("accuracy", crd.accuracy);

    // Use the URL with query parameters in the fetch request
    fetch(url) // Removed the 'body' property as it's not needed for GET requests
      .then((response) => response.text()) // Get response as text (HTML)
      .then((html) => {
        document.querySelector(".stops-wrapper").innerHTML = html; // Set HTML into the specified element
        applyClickStopListeners();
      })
      .catch((error) => console.error("Fetch error:", error));
  }

  function error(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
  }

  navigator.geolocation.getCurrentPosition(success, error, options);
});
