document.addEventListener("DOMContentLoaded", function () {
  var contactForm = document.querySelector("#contact-form");
  var contactMessage = document.querySelector(".form-message");

  contactForm.addEventListener("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(contactForm);

    fetch("/kontakt/abschicken", {
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
          let submit = contactForm.querySelector("input[type=submit]");
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
        console.error("There was a problem with the fetch operation:", error);
      });
  });
});
