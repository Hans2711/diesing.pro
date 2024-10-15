var selectedStop = null;
var stopsLoaderWrapper = document.querySelector(".stops-loader-wrapper");
var stopsErrorWrapper = document.querySelector(".stops-error-wrapper");
var stopsWrapper = document.querySelector(".stops-wrapper");
var stopWrapper = document.querySelector(".stop-wrapper");
var hardReloadButton = document.querySelector(".hard-reload-stops");

import { fetchSingleStop, fetchStops } from "./fetchHandler.js";
import { initLocation } from "./locationHandler.js";

export function initTemplate() {
    var selectedStop = null;
    var stopsLoaderWrapper = document.querySelector(".stops-loader-wrapper");
    var stopsErrorWrapper = document.querySelector(".stops-error-wrapper");
    var stopsWrapper = document.querySelector(".stops-wrapper");
    var stopWrapper = document.querySelector(".stop-wrapper");
    var hardReloadButton = document.querySelector(".hard-reload-stops");

    initLocation(locationFetchSuccess, locationError);

    hardReloadButton.addEventListener("click", function () {
        reload();
    });
}

function reload() {
    selectedStop = null;
    stopsWrapper.innerHTML = "";
    initLocation(locationFetchSuccessNoCache, locationError);
}

function updateSelectedStop(id) {
    selectedStop = id;
    stopsWrapper.querySelectorAll(".stop").forEach(function (stop) {
        if (stop.dataset.id == id) {
            stop.classList.add("stop-selected");
            fetchSingleStop(id).then((html) => {
                receiveSingleStop(html);
            });
        } else {
            if (stop.classList.contains("stop-selected")) {
                stop.classList.remove("stop-selected");
            }
        }
    });
}

function clickStop(e) {
    console.log("Stop clicked:", e.currentTarget);
    updateSelectedStop(e.currentTarget.dataset.id);
}

function applyStopsClickListeners() {
    stopsWrapper.querySelectorAll(".stop").forEach(function (stop) {
        stop.removeEventListener("click", clickStop);
        stop.addEventListener("click", clickStop);
    });
}

function receiveSingleStop(html) {
    stopWrapper.innerHTML = html;
}

function reciveStops(html) {
    stopsWrapper.innerHTML = html;
    applyStopsClickListeners();
}

function locationError(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
    stopsWrapper.innerHTML = stopsErrorWrapper.innerHTML;
    stopsWrapper.querySelector(".error").innerHTML = err.message;
}

function locationFetchSuccessNoCache(pos) {
    const crd = pos.coords;

    stopsWrapper.innerHTML = stopsLoaderWrapper.innerHTML;

    fetchStops(crd, true).then((html) => {
        reciveStops(html);
    });
}

function locationFetchSuccess(pos) {
    const crd = pos.coords;
    console.log("Your current position is:");
    console.log(`Latitude : ${crd.latitude}`);
    console.log(`Longitude: ${crd.longitude}`);
    console.log(`More or less ${crd.accuracy} meters.`);

    stopsWrapper.innerHTML = stopsLoaderWrapper.innerHTML;

    fetchStops(crd).then((html) => {
        reciveStops(html);
    });
}
