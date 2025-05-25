window.triggerLogoAnimation = () => {
    const outlinePath = document.getElementById('Outline');
    outlinePath.classList.remove('animate-outline');

    setTimeout(() => {
        outlinePath.classList.add('animate-outline');
    }, 10); // A small delay
}
