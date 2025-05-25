window.triggerLogoAnimation = () => {
    const outlinePath = document.getElementById('Outline');
    if (!outlinePath) return;
    outlinePath.classList.remove('animate-outline');

    setTimeout(() => {
        outlinePath.classList.add('animate-outline');
    }, 10); // A small delay
};

function isDesktop() {
    return window.innerWidth >= 768; // Tailwind md breakpoint
}

function handleBurgerClick() {
    if (window.innerWidth < 768) {
        window.triggerLogoAnimation();
    }
}

function observeLogo() {
    const logo = document.getElementById('logo-svg');
    if (!logo || !isDesktop()) return;

    if (window.logoObserver) {
        window.logoObserver.disconnect();
    }

    window.logoObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                window.triggerLogoAnimation();
            }
        });
    });
    window.logoObserver.observe(logo);
}

function initLogoAnimation() {
    const burgerButton = document.getElementById('burger-menu-button');
    if (burgerButton) {
        burgerButton.removeEventListener('click', handleBurgerClick);
        burgerButton.addEventListener('click', handleBurgerClick);
    }
    observeLogo();
}

