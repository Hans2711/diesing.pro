import FingerprintJS from "@fingerprintjs/fingerprintjs";
const fpPromise = new Promise((resolve) => {
    resolve(FingerprintJS.load());
});
import _, { rest } from "lodash";

document.addEventListener("livewire:navigated", () => {
    var fingerprintingButton = document.querySelector("#fingerprinting-button");
    var fingerprinting = document.querySelector("#fingerprinting");
    var fingerprintingTemplate = document.querySelector(
        "#fingerprinting-template",
    );
    var fingerprintField = document.querySelector("#fingerprint");

    fingerprintingButton.addEventListener("click", async (e) => {
        e.preventDefault();
        fpPromise.then((fp) => {
            fp.get().then((result) => {
                var templateObjects = {
                    visitorId: result.visitorId,
                    timezone: result.components.timezone.value,
                    webGlRenderer:
                        result.components.webGlBasics.value.rendererUnmasked,
                };
                let templateObj = _.template(fingerprintingTemplate.innerHTML);
                let output = templateObj(templateObjects);

                fingerprinting.innerHTML = output;
                fingerprintField.value = result.visitorId;

                e.target.classList.add("!hidden");

                const csrfToken = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");
                fetch("/fingerprint", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-CSRF-Token": csrfToken,
                    },
                    body: `fingerprint=${encodeURIComponent(result.visitorId)}`,
                })
                    .then((response) => response.text())
                    .then((data) => {
                        if (data === "1") {
                            const urlParams = new URLSearchParams(
                                window.location.search,
                            );
                            const returnUrl = urlParams.get("return_url");
                            if (returnUrl) {
                                window.location.href = returnUrl;
                            } else {
                                window.location.reload();
                            }
                        }
                    });
            });
        });
    });
});
