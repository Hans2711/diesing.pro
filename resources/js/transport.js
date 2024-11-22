const LOCATION_OPTIONS = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0,
};

function initLocation() {
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const { latitude, longitude } = position.coords;
            // Livewire.dispatch('locationUpdated', {latitude: latitude, longitude: longitude});
            Livewire.dispatchTo('transport', 'locationUpdated', {latitude, longitude});
        },
        (error) => {
            console.error('Error fetching location:', error);
            Livewire.dispatchTo('transport', 'locationError', {message: error.message});
        },
        LOCATION_OPTIONS
    );
}

var map = null;

document.addEventListener('DOMContentLoaded', () => {
    initLocation();

    window.Livewire.on('triggerDetails', function (data) {
        if (data.id) {
            getMap().then(() => {
                window.createMap(map.dataset.latitude, map.dataset.longitude, 'map');
            });
        } else {
            console.error('Invalid data passed to triggerDetails:', data);
        }
    });
})

function getMap() {
    return new Promise((resolve, reject) => {
        map = document.querySelector('#map');
        if (map == null) {
            setTimeout(() => {
                getMap().then(() => {
                    resolve();
                });
            }, 100);
        } else {
            resolve();
        }
    });
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

