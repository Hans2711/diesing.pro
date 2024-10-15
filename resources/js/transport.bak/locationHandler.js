export const LOCATION_OPTIONS = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0,
};

export function initLocation(callback, errorCallback) {
    navigator.geolocation.getCurrentPosition(callback, errorCallback, LOCATION_OPTIONS);
}
