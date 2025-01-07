document.addEventListener("DOMContentLoaded", function () {
    var contactForm = document.querySelector("#contact-form");
    var contactMessage = document.querySelector(".form-message");
    var contactSubmit = document.querySelector("#contact-submit");
    var translations = JSON.parse(
        document.querySelector('meta[name="translations-text"]').content,
    );

    contactForm.addEventListener("submit", function (event) {
        event.preventDefault();

        contactSubmit.value = translations.submiting;

        var formData = new FormData(contactForm);

        fetch(window.location.href + "/submit", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error("Network response was not ok");
                }
            })
            .then((data) => {
                if (data.success) {
                    let submit =
                        contactForm.querySelector("input[type=submit]");
                    submit.setAttribute("disabled", "disabled");

                    contactForm.classList.add("slide-out-up");
                    contactForm.addEventListener(
                        "animationend",
                        function () {
                            contactForm.style.display = "none";
                            contactMessage.innerHTML = data.message;
                        },
                        { once: true },
                    );
                }
            })
            .catch((error) => {
                console.error(
                    "There was a problem with the fetch operation:",
                    error,
                );
            });
    });
});
