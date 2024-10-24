import { showLoader, hideLoader } from "./loaderHandler.js";
import _ from "lodash";

export default class StopsTimelineHandler {
  constructor(stopsButton) {
    this.stopsButton = stopsButton;
    this.stopsTimelineModal = document.querySelector(
      ".stops-timeline-modal-wrapper",
    );
  }

  init() {
    console.log(this.stopsButton.dataset.stops);
  }

  uninstall() {}
}
