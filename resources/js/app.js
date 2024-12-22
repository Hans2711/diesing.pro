import "./bootstrap";
import "../css/app.css";

import.meta.glob([
    "../logo/**",
    "../portfolio/**",
    "../images/**",
    "../icons/**",
]);

document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#menu-img").addEventListener("click", (img) => {
        let list = document.querySelector("#header-list");
        img.target.src.contains("menu")
            ? ((img.target.src = img.target.src.replace("menu", "close")),
              list.classList.add("top-[80px]"),
              list.classList.add("opacity-100"))
            : ((img.target.src = img.target.src.replace("close", "menu")),
              list.classList.remove("top-[80px]"),
              list.classList.remove("opacity-100"));
    });
});

window.triggerLanguageDropdown = (e) => {
    let dropdown = document.querySelector("#language-dropdown");
    dropdown.classList.toggle("hidden");

    let img = e.querySelector("img[alt='Chevron']");

    if (img.src.contains("down")) {
        img.src = img.src.replace("down", "up");
    } else {
        img.src = img.src.replace("up", "down");
    }
};

document.addEventListener("click", function (event) {
    const button = document.getElementById("language-button");
    const menu = document.getElementById("language-dropdown");

    if (!button.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.add("hidden");
    }
});
