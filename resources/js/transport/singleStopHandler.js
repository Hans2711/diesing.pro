import {
  fetchSingleStop,
  fetchSingleStopArrivals,
  fetchSingleStopDepartures,
} from "./fetchHandler.js";
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
    fetchSingleStop(this.stopItem.dataset.id)
      .then((json) => {
        console.log(json);
        this.receiveSingleStop(json);

        // createMap(
        //   this.stopWrapper.querySelector(".station").dataset.lat,
        //   this.stopWrapper.querySelector(".station").dataset.lon,
        // );
      })
      .catch((error) => {
        this.displayError(error.message);
      });

    this.closeButton.addEventListener("click", this.closeModal.bind(this));
  }

  closeModal() {
    this.stopModalWrapper.classList.add("hidden");
  }

  receiveSingleStop(json) {
    var compiledTemplate = _.template(this.stopTemplate);
    var renderedHTML = compiledTemplate(json);
    this.stopWrapper.innerHTML = renderedHTML;
    this.stopModalWrapper.classList.remove("hidden");
    // this.applyListeners();
  }

  uninstall() {
    this.closeButton.removeEventListener("click", this.closeModal.bind(this));
  }

  displayError(errorMessage) {
    this.stopWrapper.innerHTML = `<p class="error">${errorMessage}</p>`;
  }
}
