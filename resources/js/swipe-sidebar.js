document.addEventListener('DOMContentLoaded', () => {
  let touchStartX = 0;
  let touchEndX = 0;
  const threshold = 50; // Minimum distance to be considered a swipe

  function isMobile() {
    return window.innerWidth < 768; // Tailwind md breakpoint
  }

  function handleTouchStart(e) {
    if (!isMobile()) return;
    touchStartX = e.changedTouches[0].screenX;
  }

  function handleTouchEnd(e) {
    if (!isMobile()) return;
    touchEndX = e.changedTouches[0].screenX;
    const diffX = touchEndX - touchStartX;
    if (Math.abs(diffX) > threshold) {
      if (diffX > 0) {
        window.dispatchEvent(new CustomEvent('swiperight'));
      } else {
        window.dispatchEvent(new CustomEvent('swipeleft'));
      }
    }
  }

  document.addEventListener('touchstart', handleTouchStart, { passive: true });
  document.addEventListener('touchend', handleTouchEnd, { passive: true });
});
