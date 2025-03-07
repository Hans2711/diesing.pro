import menuIcon from "../../icons/menu.svg";
import closeIcon from "../../icons/close.svg";

import chevronUp from "../../icons/chevron-up.svg";
import chevronDown from "../../icons/chevron-down.svg";

document.addEventListener("livewire:navigated", () => {
    setupHeaderMenu();
});

function setupHeaderMenu() {
    console.log("Setting up header menu");
    const menuImage = document.querySelector("#menu-img");
    const handleMenuClick = (event) => {
        const currentSrc = event.target.src;
        let list = document.querySelector("#header-list");

        if (currentSrc.includes(menuIcon)) {
            event.target.src = closeIcon;
            list.classList.add("top-[80px]");
            list.classList.add("opacity-100");
        } else {
            event.target.src = menuIcon;
            list.classList.remove("top-[80px]");
            list.classList.remove("opacity-100");
        }
    };

    menuImage.removeEventListener("click", handleMenuClick);
    menuImage.addEventListener("click", handleMenuClick);
}

window.triggerLanguageDropdown = (e) => {
    let dropdown = document.querySelector("#language-dropdown");
    dropdown.classList.toggle("hidden");

    let img = e.querySelector("img[alt='Chevron']");

    if (img.src.includes("down")) {
        img.src = chevronUp;
    } else {
        img.src = chevronDown;
    }
};

document.addEventListener("click", function (event) {
    const button = document.getElementById("language-button");
    const menu = document.getElementById("language-dropdown");

    if (!button.contains(event.target) && !menu.contains(event.target)) {
        menu.classList.add("hidden");
        let img = button.querySelector("img[alt='Chevron']");
        if (img.src.includes("up")) {
            img.src = chevronDown;
        }
    }
});
