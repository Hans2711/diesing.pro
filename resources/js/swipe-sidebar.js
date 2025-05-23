document.addEventListener('DOMContentLoaded', () => {
    let touchStartX = 0;
    let touchStartY = 0;
    let touchEndX = 0;
    let touchEndY = 0;
    const maxVerticalSwipe = 100; // Maximum vertical distance to be considered a swipe

    function isMobile() {
        return window.innerWidth < 768; // Tailwind md breakpoint
    }

    function handleTouchStart(e) {
        if (!isMobile()) return;
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    }

    function handleTouchEnd(e) {
        if (!isMobile()) return;
        touchEndX = e.changedTouches[0].screenX;
        touchEndY = e.changedTouches[0].screenY;
        const diffX = touchEndX - touchStartX;
        const diffY = touchEndY - touchStartY;

        if (Math.abs(diffY) <= maxVerticalSwipe && Math.abs(diffX) > Math.abs(diffY)) {
            if (diffX > 0) {
                window.dispatchEvent(new CustomEvent('swiperight'));
            } else {
                window.dispatchEvent(new CustomEvent('swipeleft'));
            }
        }
    }

    document.addEventListener('touchstart', handleTouchStart, { passive: false });
    document.addEventListener('touchend', handleTouchEnd, { passive: false });
});
