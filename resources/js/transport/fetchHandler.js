export function fetchStops(crd, disableCache = false) {
  return new Promise((resolve, reject) => {
    const url = new URL("/transport/fetch", window.location.origin);
    url.searchParams.append("lati", crd.latitude);
    url.searchParams.append("long", crd.longitude);
    url.searchParams.append("accuracy", crd.accuracy);
    url.searchParams.append("disableCache", disableCache);

    fetch(url)
      .then((response) => {
        return response.json().then((json) => {
          if (response.ok) {
            resolve(json);
          } else {
            // Reject the promise with the JSON error message
            reject(json);
          }
        });
      })
      .catch((error) => {
        console.error("Fetch error:", error);
        reject(error);
      });
  });
}

export function fetchStopsSearch(query, disableCache = false) {
  return new Promise((resolve, reject) => {
    const url = new URL("/transport/search", window.location.origin);
    url.searchParams.append("query", query);
    url.searchParams.append("disableCache", disableCache);

    fetch(url)
      .then((response) => response.text())
      .then((html) => {
        resolve(html);
      })
      .catch((error) => {
        console.error("Fetch error:", error);
        reject(error);
      });
  });
}

export function fetchSingleStop(id, type = "stop") {
  return new Promise((resolve, reject) => {
    const url = new URL(`/transport/fetch/${id}`, window.location.origin);

    fetch(url)
      .then((response) => {
        return response.json().then((json) => {
          if (response.ok) {
            resolve(json);
          } else {
            reject(json);
          }
        });
      })
      .catch((error) => {
        console.error("Fetch error:", error);
        reject(error);
      });
  });
}

export function fetchTrips(id, type = "arrival", options = {}) {
  return new Promise((resolve, reject) => {
    const url = new URL(
      `/transport/fetch/trips/${id}/${type}`,
      window.location.origin,
    );

    // Add options as GET parameters
    Object.keys(options).forEach((key) => {
      url.searchParams.append(key, options[key]);
    });

    fetch(url)
      .then((response) => {
        return response.json().then((json) => {
          if (response.ok) {
            resolve(json);
          } else {
            reject(json);
          }
        });
      })
      .catch((error) => {
        console.error("Fetch error:", error);
        reject(error);
      });
  });
}
