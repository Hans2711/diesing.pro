import { fetchSingleStop, fetchTrips } from "./fetchHandler.js";
import { showLoader, hideLoader } from "./loaderHandler.js";
import TripsHandler from "./tripsHandler.js";
import _ from "lodash";
import { createMap } from "./mapHandler.js";

export default class SingleStopHandler {
  constructor(stopItem) {
    this.stopItem = stopItem;
    this.stopWrapper = document.querySelector(".stop-wrapper");
    this.stopModalWrapper = document.querySelector(".stop-modal-wrapper");
    this.closeButton = this.stopModalWrapper.querySelector(".close-button");
    this.stopModalBackground = document.querySelector(".stop-modal-background");

    this.stopTemplate = document.getElementById("stop-template").innerHTML;
  }

  init() {
    showLoader();
    fetchSingleStop(this.stopItem.dataset.id)
      .then((json) => {
        console.log(json);
        this.receiveSingleStop(json);

        this.tripsHandler = new TripsHandler(this.stopItem);
        this.tripsHandler.init();

        createMap(
          this.stopWrapper.querySelector(".station").dataset.lat,
          this.stopWrapper.querySelector(".station").dataset.lon,
        );
      })
      .catch((error) => {
        this.displayError(error.message);
      });
  }

  triggerOptionsDropdown() {
    this.optionsDropdown.classList.toggle("hidden");
  }

  closeModal() {
    this.stopModalWrapper.classList.add("hidden");

    if (this.tripsHandler) {
      this.tripsHandler.uninstall();
      this.tripsHandler = null;
    }
  }

  applyListeners() {
    this.optionsDropdownButton = this.stopWrapper.querySelector(
      "#options-dropdown-button",
    );
    this.optionsDropdown = this.stopWrapper.querySelector("#options-dropdown");

    this.closeButton.addEventListener("click", this.closeModal.bind(this));
    this.optionsDropdownButton.addEventListener(
      "click",
      this.triggerOptionsDropdown.bind(this),
    );
  }

  receiveSingleStop(json) {
    var compiledTemplate = _.template(this.stopTemplate);
    var renderedHTML = compiledTemplate(json);
    this.stopWrapper.innerHTML = renderedHTML;
    this.stopModalWrapper.classList.remove("hidden");

    this.applyListeners();
    hideLoader();
  }

  uninstall() {
    this.closeButton.removeEventListener("click", this.closeModal.bind(this));
    if (this.tripsHandler) {
      this.tripsHandler.uninstall();
      this.tripsHandler = null;
    }
  }

  displayError(errorMessage) {
    this.stopWrapper.innerHTML = `<p class="error">${errorMessage}</p>`;
    hideLoader();
  }
}
