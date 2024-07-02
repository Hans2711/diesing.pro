document.addEventListener('DOMContentLoaded', function() {
    var redirectModal = document.querySelector('#redirect-modal');
    var addRedirectButton = document.querySelector('#add-redirect');

    addRedirectButton.addEventListener('click', function() {
        redirectModal.classList.remove('hidden');
    });

});
