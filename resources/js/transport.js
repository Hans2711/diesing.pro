import TransportApp from "./transport/transportApp.js";
import { showLoader, hideLoader } from "./transport/loaderHandler.js";

document.addEventListener("DOMContentLoaded", function () {
  const app = new TransportApp();
  showLoader();
  app.init();
});
