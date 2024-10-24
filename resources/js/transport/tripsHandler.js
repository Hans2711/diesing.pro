import { fetchTrips } from "./fetchHandler.js";
import { showLoader, hideLoader } from "./loaderHandler.js";
import TripsDetailHandler from "./tripDetailsHandler.js";
import _ from "lodash";

export default class TripsHandler {
  constructor(stopItem) {
    this.stopItem = stopItem;
    this.stopWrapper = document.querySelector(".stop-wrapper");
    this.tripsForm = this.stopWrapper.querySelector(".trips");
    this.tripsFormType = this.tripsForm.querySelector("select[name='type']");
    this.tripsWrapper = this.stopWrapper.querySelector(".trips-wrapper");
    this.tripsTemplate = document.getElementById("trips-template").innerHTML;
    this.updateInterval = null;
    this.tripsDetailHandler = null;
  }

  init() {
    this.tripsForm.addEventListener("submit", this.handleSubmit.bind(this));
  }

  uninstall() {
    this.tripsForm.removeEventListener("submit", this.handleSubmit.bind(this));
    if (this.updateInterval !== null) {
      clearInterval(this.updateInterval); // Clear the interval
      this.updateInterval = null;
    }
    if (this.tripsDetailHandler) {
      this.tripsDetailHandler.uninstall();
      this.tripsDetailHandler = null;
    }
  }

  handleSubmit(e) {
    e.preventDefault();
    showLoader();
    console.log(e);

    const formData = new FormData(e.target);
    const options = {};

    formData.forEach((value, key) => {
      options[key] = value;
    });

    fetchTrips(this.stopItem.dataset.id, this.tripsFormType.value, options)
      .then((json) => {
        console.log(json);
        this.receiveTrips(json);
      })
      .catch((error) => {
        console.log(error);
        this.displayError(error.message);
      });
  }

  receiveTrips(json) {
    var trips = null;
    var type = null;
    if (json.arrivals) {
      trips = json.arrivals;
      type = "arrivals";
    }
    if (json.departures) {
      trips = json.departures;
      type = "departures";
    }

    const compiledTemplate = _.template(this.tripsTemplate);
    const renderedHTML = compiledTemplate({ trips: trips, type: type });
    this.tripsWrapper.innerHTML = renderedHTML;

    // Process dates after rendering
    this.processDates();

    if (this.updateInterval === null) {
      this.updateInterval = setInterval(() => {
        this.processDates();
      }, 10000); // Update every 10 seconds
    }

    if (this.tripsDetailHandler == null) {
      this.tripsDetailHandler = new TripsDetailHandler();
      this.tripsDetailHandler.init();
    }

    hideLoader();
  }
  // Date processing methods

  processDates() {
    const trips = this.tripsWrapper.querySelectorAll(".trip");
    trips.forEach((trip) => {
      const plannedWhenElem = trip.querySelector(".plannedWhen");
      const whenElem = trip.querySelector(".when");

      const plannedWhenTimestamp =
        plannedWhenElem.getAttribute("data-timestamp");
      const whenTimestamp = whenElem
        ? whenElem.getAttribute("data-timestamp")
        : null;

      if (plannedWhenTimestamp) {
        const plannedWhenFullDate = this.formatFullDate(plannedWhenTimestamp);
        plannedWhenElem.setAttribute("title", plannedWhenFullDate);
        plannedWhenElem.setAttribute("alt", plannedWhenFullDate);

        let date = new Date(plannedWhenTimestamp);
        let hours = String(date.getHours()).padStart(2, "0");
        let minutes = String(date.getMinutes()).padStart(2, "0");

        const relativeTime = this.getRelativeTime(plannedWhenTimestamp);
        plannedWhenElem.textContent =
          relativeTime + " (" + hours + ":" + minutes + ")";
      }

      if (whenTimestamp) {
        const whenFullDate = this.formatFullDate(whenTimestamp);
        whenElem.setAttribute("title", whenFullDate);
        whenElem.setAttribute("alt", whenFullDate);

        const relativeTime = this.getRelativeTime(whenTimestamp);

        let date = new Date(whenTimestamp);
        let hours = String(date.getHours()).padStart(2, "0");
        let minutes = String(date.getMinutes()).padStart(2, "0");

        whenElem.textContent =
          relativeTime + " (" + hours + ":" + minutes + ")";
      }
    });
  }

  formatFullDate(dateStr) {
    const date = new Date(dateStr);
    const day = String(date.getDate()).padStart(2, "0");
    const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are zero-based
    const year = date.getFullYear();
    const hours = String(date.getHours()).padStart(2, "0");
    const minutes = String(date.getMinutes()).padStart(2, "0");
    return `${day}.${month}.${year} ${hours}:${minutes}`;
  }

  getRelativeTime(dateStr) {
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

    return (isFuture ? "+ " : "- ") + relativeTime;
  }

  displayError(errorMessage) {
    this.tripsWrapper.innerHTML = `<p class="error">${errorMessage}</p>`;
    hideLoader();
  }
}
