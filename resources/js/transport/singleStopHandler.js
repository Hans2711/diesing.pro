import { fetchSingleStop, fetchSingleStopArrivals, fetchSingleStopDepartures } from './fetchHandler.js';
import { createMap } from './mapHandler.js';

export default class SingleStopHandler {
    constructor(stopId, stopWrapper) {
        this.stopId = stopId;
        this.stopWrapper = stopWrapper;

        this.arrivalSubmitListener = this.arrivalSubmitListener.bind(this);
        this.departureSubmitListener = this.departureSubmitListener.bind(this);
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
        const arrivalForm = this.stopWrapper.querySelector('.arrivals form');
        const departureForm = this.stopWrapper.querySelector('.departures form');

        if (arrivalForm) {
            arrivalForm.removeEventListener('submit', this.arrivalSubmitListener);
            arrivalForm.addEventListener('submit', this.arrivalSubmitListener);
        }

        if (departureForm) {
            departureForm.removeEventListener('submit', this.departureSubmitListener);
            departureForm.addEventListener('submit', this.departureSubmitListener);
        }
    }

    arrivalSubmitListener(event) {
        event.preventDefault();
        const form = event.target;
        const formElements = form.elements;
        const params = {};

        for (let i = 0; i < formElements.length; i++) {
            const element = formElements[i];
            const name = element.name;
            if (!name) continue;

            if (element.type === 'checkbox') {
                params[name] = element.checked ? 'true' : 'false';
            } else {
                params[name] = element.value;
            }
        }

        fetchSingleStopArrivals(this.stopId, params)
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

    departureSubmitListener(event) {
        event.preventDefault();
        const form = event.target;
        const formElements = form.elements;
        const params = {};

        for (let i = 0; i < formElements.length; i++) {
            const element = formElements[i];
            const name = element.name;
            if (!name) continue;

            if (element.type === 'checkbox') {
                params[name] = element.checked ? 'true' : 'false';
            } else {
                params[name] = element.value;
            }
        }

        fetchSingleStopDepartures(this.stopId, params)
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
