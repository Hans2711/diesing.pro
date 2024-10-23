import './bootstrap';
import '../css/app.css';

import.meta.glob([
  '../logo/**',
  '../portfolio/**',
  '../images/**',
]);


document.addEventListener("DOMContentLoaded", function() {
    // Check if the device width is less than or equal to 768 pixels
    if (window.innerWidth <= 768) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;

            document.querySelectorAll('.parallax-image').forEach((element) => {
                const speed = element.getAttribute('data-speed') || 0.5; // Adjust speed if necessary
                element.style.backgroundPositionY = `-${scrollPosition * speed}px`;
            });
        });
    }
});
