import { fetchTrips } from "./fetchHandler.js";
import _ from "lodash";

export default class TripsHandler {
  constructor(stopItem) {
    this.stopItem = stopItem;
    this.stopWrapper = document.querySelector(".stop-wrapper");
    this.tripsForm = this.stopWrapper.querySelector(".trips");
    this.tripsFormType = this.tripsForm.querySelector("select[name='type']");
    this.tripsWrapper = this.stopWrapper.querySelector(".trips-wrapper");
    this.tripsTemplate = document.getElementById("trips-template").innerHTML;
  }

  init() {
    this.tripsForm.addEventListener("submit", this.handleSubmit.bind(this));
  }

  uninstall() {
    this.tripsForm.removeEventListener("submit", this.handleSubmit.bind(this));
  }

  handleSubmit(e) {
    e.preventDefault();
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
        this.displayError(error.message);
      });
  }

  receiveTrips(json) {
    var compiledTemplate = _.template(this.tripsTemplate);
    var renderedHTML = compiledTemplate(json);
    this.tripsWrapper.innerHTML = renderedHTML;
  }

  displayError(errorMessage) {
    this.tripsWrapper.innerHTML = `<p class="error">${errorMessage}</p>`;
  }
}
