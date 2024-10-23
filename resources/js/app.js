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
                const speed = element.getAttribute('data-speed') || 0.1; // Adjust speed if necessary
                const elementHeight = element.offsetHeight; // Get the height of the element

                // Calculate new background position
                let newYPosition = -scrollPosition

                // Limit the new Y position to not exceed the image height
                newYPosition = Math.max(newYPosition, -elementHeight); // Prevent moving higher than image height

                newYPosition = newYPosition * speed; // Adjust speed as needed

                element.style.backgroundPositionY = `${newYPosition}px`;
            });
        });
    }
});
