export function fetchStops(crd, disableCache = false) {
    return new Promise((resolve, reject) => {
        const url = new URL("/transport/fetch", window.location.origin);
        url.searchParams.append("lati", crd.latitude);
        url.searchParams.append("long", crd.longitude);
        url.searchParams.append("accuracy", crd.accuracy);
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

export function fetchSingleStop(id) {
    return new Promise((resolve, reject) => {
        const url = new URL(`/transport/fetch/${id}`, window.location.origin);

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

export function fetchSingleStopArrivals(id, params = {}) {
    return new Promise((resolve, reject) => {
        const url = new URL(`/transport/fetch/${id}/arrivals`, window.location.origin);
        Object.keys(params).forEach(key => {
            url.searchParams.append(key, params[key]);
        });

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

export function fetchSingleStopDepartures(id, params = {}) {
    return new Promise((resolve, reject) => {
        const url = new URL(`/transport/fetch/${id}/departures`, window.location.origin);
        Object.keys(params).forEach(key => {
            url.searchParams.append(key, params[key]);
        });

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

