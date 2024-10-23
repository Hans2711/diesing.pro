  document.addEventListener('scroll', function() {
    const parallaxElements = document.querySelectorAll('.paralax-image');
    const scrollY = window.scrollY;

    parallaxElements.forEach(function(parallax) {
      // Slide the background up based on scroll position
      parallax.style.backgroundPositionY = `-${scrollY * 0.2}px`; // Adjust speed as needed
    });
  });
