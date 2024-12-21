import "./bootstrap";
import "../css/app.css";

import.meta.glob([
    "../logo/**",
    "../portfolio/**",
    "../images/**",
    "../icons/**",
]);

window.Menu = (img) => {
    let list = document.querySelector("#header-list");
    img.src.endsWith("menu.svg")
        ? ((img.src = img.src.replace("menu.svg", "close.svg")),
          list.classList.add("top-[80px]"),
          list.classList.add("opacity-100"))
        : ((img.src = img.src.replace("close.svg", "menu.svg")),
          list.classList.remove("top-[80px]"),
          list.classList.remove("opacity-100"));
};

window.triggerLanguageDropdown = (e) => {
    let dropdown = document.querySelector("#language-dropdown");
    dropdown.classList.toggle("hidden");

    let img = e.querySelector("img[alt='Chevron']");

    if (img.src.endsWith("down.svg")) {
        img.src = img.src.replace("down", "up");
    } else {
        img.src = img.src.replace("up", "down");
    }

    console.log(img);
};

document.addEventListener("click", function (event) {
    const button = document.getElementById("language-button");
    const menu = document.getElementById("language-dropdown");

    if (!button.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.add("hidden");
    }
});
