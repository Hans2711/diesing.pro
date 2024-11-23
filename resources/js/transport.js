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

    let tripsIntervalId = null;

    window.Livewire.on('triggerTrips', function (data) {
        if (data.id) {
            const resetListeners = () => {
                const remarkParagraphs = document.querySelectorAll('p[data-text]');
                remarkParagraphs.forEach(paragraph => {
                    paragraph.removeEventListener("click", toggleText);
                    paragraph.addEventListener("click", toggleText);
                });
            };

            const toggleText = function () {
                const temp = this.innerText;
                this.innerText = this.getAttribute("data-text");
                this.setAttribute("data-text", temp);
            };

            resetListeners();

            if (tripsIntervalId !== null) {
                clearInterval(tripsIntervalId);
            }

            tripsIntervalId = setInterval(resetListeners, 1500);

            window.Livewire.on('stopTripsInterval', function () {
                if (tripsIntervalId !== null) {
                    clearInterval(tripsIntervalId);
                    tripsIntervalId = null;
                }
            });
        } else {
            console.error('Invalid data passed to triggerTrips:', data);
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

function processDates() {
    const timeTrackers = document.querySelectorAll('.time-tracker');
    timeTrackers.forEach((trip) => {

        let timestamp = trip.dataset.timestamp;

        if (timestamp) {

            const whenFullDate = formatFullDate(timestamp);
            trip.setAttribute("title", whenFullDate);
            trip.setAttribute("alt", whenFullDate);

            const relativeTime = getRelativeTime(timestamp);

            let date = new Date(timestamp);
            let hours = String(date.getHours()).padStart(2, "0");
            let minutes = String(date.getMinutes()).padStart(2, "0");

            trip.textContent =
                relativeTime + " (" + hours + ":" + minutes + ")";
        }
    });
}

function formatFullDate(dateStr) {
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are zero-based
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, "0");
    const minutes = String(date.getMinutes()).padStart(2, "0");
    return `${day}.${month}.${year} ${hours}:${minutes}`;
}

function getRelativeTime(dateStr) {
    const now = new Date();
    const date = new Date(dateStr);
    let diff = date - now; // Difference in milliseconds
    const isFuture = diff > 0;
    diff = Math.abs(diff);

    const totalMinutes = Math.floor(diff / (1000 * 60));
    const hours = Math.floor(totalMinutes / 60);
    const minutes = totalMinutes % 60;

    let relativeTime = "";
    if (hours > 0) {
        relativeTime += `${hours} hour${hours !== 1 ? "s" : ""}`;
        if (minutes > 0) {
            relativeTime += ` & ${minutes} min${minutes !== 1 ? "s" : ""}`;
        }
    } else if (minutes > 0) {
        relativeTime += `${minutes} min${minutes !== 1 ? "s" : ""}`;
    } else {
        relativeTime = "now";
    }

    let status = "";

    if (relativeTime != "now") {
        if (isFuture) {
            return "in " + relativeTime;
        } else {
            return relativeTime + " ago";
        }
    }

    return status + relativeTime;
}

setInterval(() => {
    processDates();
}, 1000);
