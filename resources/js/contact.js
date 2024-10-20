document.addEventListener("DOMContentLoaded", function () {
  var contactForm = document.querySelector("#contact-form");
  var contactMessage = contactForm.querySelector(".message");

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
          contactMessage.innerHTML = data.message;
        }
      })
      .catch((error) => {
        console.error("There was a problem with the fetch operation:", error);
      });
  });
});
