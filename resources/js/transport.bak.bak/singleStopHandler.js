import { fetchSingleStop, fetchSingleStopArrivals, fetchSingleStopDepartures } from './fetchHandler.js';
import { createMap } from './mapHandler.js';

export default class SingleStopHandler {
    constructor(stopId, stopWrapper) {
        this.stopId = stopId;
        this.stopWrapper = stopWrapper;

        // Bind methods
        this.arrivalClickListener = this.arrivalClickListener.bind(this);
        this.departureClickListener = this.departureClickListener.bind(this);
    }

    init() {
        fetchSingleStop(this.stopId)
            .then((html) => {
                this.receiveSingleStop(html);
                createMap(this.stopWrapper.querySelector('.station').dataset.lat, this.stopWrapper.querySelector('.station').dataset.lon);
            })
            .catch((error) => {
                this.displayError(error.message);
            });

    }

    receiveSingleStop(html) {
        this.stopWrapper.innerHTML = html;
        this.applyListeners();


    }

    applyListeners() {
        const arrivalButton = this.stopWrapper.querySelector('.arrival');
        const departureButton = this.stopWrapper.querySelector('.departure');

        if (arrivalButton) {
            arrivalButton.removeEventListener('click', this.arrivalClickListener);
            arrivalButton.addEventListener('click', this.arrivalClickListener);
        }

        if (departureButton) {
            departureButton.removeEventListener('click', this.departureClickListener);
            departureButton.addEventListener('click', this.departureClickListener);
        }
    }

    arrivalClickListener() {
        fetchSingleStopArrivals(this.stopId)
            .then((html) => {
                const arrivalsWrapper = this.stopWrapper.querySelector('.arrivals-wrapper');
                if (arrivalsWrapper) {
                    arrivalsWrapper.innerHTML = html;
                }
            })
            .catch((error) => {
                console.error("Error fetching arrivals:", error);
                this.displayError("Error fetching arrivals.");
            });
    }

    departureClickListener() {
        fetchSingleStopDepartures(this.stopId)
            .then((html) => {
                const departuresWrapper = this.stopWrapper.querySelector('.departures-wrapper');
                if (departuresWrapper) {
                    departuresWrapper.innerHTML = html;
                }
            })
            .catch((error) => {
                console.error("Error fetching departures:", error);
                this.displayError("Error fetching departures.");
            });
    }

    displayError(errorMessage) {
        this.stopWrapper.innerHTML = `<p class="error">${errorMessage}</p>`;
    }
}
