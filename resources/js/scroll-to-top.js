function initScrollToTop() {
    const button = document.getElementById('scroll-top-button');
    if (!button) return;

    function toggleVisibility() {
        if (window.scrollY > window.innerHeight) {
            button.classList.remove('hidden');
        } else {
            button.classList.add('hidden');
        }
    }

    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.removeEventListener('scroll', toggleVisibility);
    window.addEventListener('scroll', toggleVisibility);

    button.removeEventListener('click', scrollToTop);
    button.addEventListener('click', scrollToTop);

    toggleVisibility();
}

document.addEventListener('DOMContentLoaded', initScrollToTop);
document.addEventListener('livewire:navigated', initScrollToTop);
if (window.Livewire) {
    Livewire.hook('morphed', initScrollToTop);
}
