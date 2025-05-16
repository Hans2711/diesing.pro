const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
        }
        else {
            entry.target.classList.remove('fade-in');
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    initGradientScroll();
});

function initGradientScroll() {
    const elements = document.querySelectorAll('.primary-gradient');
    if (elements.length > 0) {
        elements.forEach((element) => {
            observer.observe(element);
        });
    }
}

document.addEventListener("livewire:navigated", initGradientScroll);

Livewire.hook("morphed", (componet) => {
    initGradientScroll();
});
