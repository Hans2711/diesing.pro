import { fetchTripDetails } from "./fetchHandler.js";
import { showLoader, hideLoader } from "./loaderHandler.js";
import StopsTimelineHandler from "./stopsTimelineHandler.js";
import { createMap } from "./mapHandler.js";
import sha256 from "crypto-js/sha256";
import _ from "lodash";

export default class TripDetailHandler {
    constructor() {
        this.tripDetailsButtons = document.querySelectorAll(".trip-details-button");
        this.tripDetailsTemplate = document.getElementById(
            "trip-details-template",
        ).innerHTML;

        this.stopsTimelineButton = null;
        this.stopsTimelineHandler = null;
    }

    init() {
        this.tripDetailsButtons.forEach((button) => {
            button.addEventListener("click", this.detailsButtonClick.bind(this));
        });
    }

    detailsButtonClick(e) {
        showLoader();
        fetchTripDetails(e.target.parentElement.dataset.id)
            .then((json) => {
                console.log(e, json);
                this.receiveTripDetails(e, json);
            })
            .catch((error) => {
                console.log(error);
                this.displayError(error.message);
            });
    }

    receiveTripDetails(e, json) {
        const compiledTemplate = _.template(this.tripDetailsTemplate);
        const renderedHTML = compiledTemplate({ unique: sha256(json), trip: json });
        let detailswrapper = e.target.parentElement.querySelector(
            ".trip-details-wrapper",
        );
        detailswrapper.innerHTML = renderedHTML;

        createMap(
            json.trip.currentLocation.latitude,
            json.trip.currentLocation.longitude,
            sha256(json).toString(),
        );

        if (this.stopsTimelineButton == null) {
            this.stopsTimelineButton = e.target.parentElement.querySelector(
                ".stops-timeline-modal-button",
            );

            this.stopsTimelineButton.addEventListener(
                "click",
                this.openStopsTimeline.bind(this),
            );
        }

        hideLoader();
    }

    openStopsTimeline(e) {
        if (this.stopsTimelineHandler == null) {
            this.stopsTimelineHandler = new StopsTimelineHandler(e.target);
            this.stopsTimelineHandler.init();
        }
    }

    uninstall() {
        this.tripDetailsButtons.forEach((button) => {
            button.removeEventListener("click", this.detailsButtonClick.bind(this));
        });

        if (this.stopsTimelineButton) {
            this.stopsTimelineButton.removeEventListener(
                "click",
                this.openStopsTimeline.bind(this),
            );
        }

        if (this.stopsTimelineHandler) {
            this.stopsTimelineHandler = null;
        }
    }

    displayError(errorMessage) {
        let detailswrapper = (this.tripDetailsButtons.parentElement.querySelector(
            ".trip-details-wrapper",
        ).innerHTML = `<p class="error">${errorMessage}</p>`);

        hideLoader();
    }
}
