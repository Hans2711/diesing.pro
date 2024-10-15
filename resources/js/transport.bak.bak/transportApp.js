import { fetchStops } from './fetchHandler.js';
import { initLocation } from './locationHandler.js';
import SingleStopHandler from './singleStopHandler.js';

export default class TransportApp {
    constructor() {
        this.selectedStop = null;
        this.stopsLoaderWrapper = document.querySelector(".stops-loader-wrapper");
        this.stopsErrorWrapper = document.querySelector(".stops-error-wrapper");
        this.stopsWrapper = document.querySelector(".stops-wrapper");
        this.stopWrapper = document.querySelector(".stop-wrapper");
        this.hardReloadButton = document.querySelector(".hard-reload-stops");

        this.singleStopHandler = null;
    }

    init() {
        this.locationFetchSuccess = this.locationFetchSuccess.bind(this);
        this.locationFetchSuccessNoCache = this.locationFetchSuccessNoCache.bind(this);
        this.locationError = this.locationError.bind(this);
        this.clickStop = this.clickStop.bind(this);

        initLocation(this.locationFetchSuccess, this.locationError);

        this.hardReloadButton.addEventListener("click", () => {
            this.reload();
        });
    }

    reload() {
        this.selectedStop = null;
        this.stopsWrapper.innerHTML = "";
        this.stopWrapper.innerHTML = "";
        initLocation(this.locationFetchSuccessNoCache, this.locationError);
    }

    updateSelectedStop(id) {
        this.selectedStop = id;
        this.stopsWrapper.querySelectorAll(".stop").forEach((stop) => {
            if (stop.dataset.id == id) {
                stop.classList.add("stop-selected");

                // Initialize the SingleStopHandler
                this.singleStopHandler = new SingleStopHandler(id, this.stopWrapper);
                this.singleStopHandler.init();

            } else {
                stop.classList.remove("stop-selected");
            }
        });
    }

    clickStop(e) {
        this.updateSelectedStop(e.currentTarget.dataset.id);
    }

    applyStopsClickListeners() {
        this.stopsWrapper.querySelectorAll(".stop").forEach((stop) => {
            stop.removeEventListener("click", this.clickStop);
            stop.addEventListener("click", this.clickStop);
        });
    }

    receiveStops(html) {
        this.stopsWrapper.innerHTML = html;
        this.applyStopsClickListeners();
    }

    displayError(wrapper, errorMessage) {
        wrapper.innerHTML = this.stopsErrorWrapper.innerHTML;
        wrapper.querySelector(".error").innerHTML = errorMessage;
    }

    displayLoader() {
        this.stopsWrapper.innerHTML = this.stopsLoaderWrapper.innerHTML;
    }

    locationError(err) {
        this.displayError(this.stopsWrapper, err.message);
    }

    locationFetchSuccessNoCache(pos) {
        const crd = pos.coords;
        this.displayLoader();

        fetchStops(crd, true)
            .then((html) => {
                this.receiveStops(html);
            })
            .catch((error) => {
                this.displayError(this.stopsWrapper, error.message);
            });
    }

    locationFetchSuccess(pos) {
        const crd = pos.coords;
        this.displayLoader();

        fetchStops(crd)
            .then((html) => {
                this.receiveStops(html);
            })
            .catch((error) => {
                this.displayError(this.stopsWrapper, error.message);
            });
    }
}

