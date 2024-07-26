import { copyText} from './utils/clipboard.js';

document.addEventListener('DOMContentLoaded', function() {
    var redirectModal = document.querySelector('#redirect-modal');
    var addRedirectButton = document.querySelector('#add-redirect');

    var redirectModalClose = redirectModal.querySelector('#close');
    var redirectModalCloseCopy = redirectModal.querySelector('#close-copy');
    var redirectModalNameInput = redirectModal.querySelector('#name');
    var redirectModalIdInput = redirectModal.querySelector('#id');
    var redirectModalTargetInput = redirectModal.querySelector('#target');
    var redirectModalCodeInput = redirectModal.querySelector('#code');
    var redirectModalUrlInput = redirectModal.querySelector('#url');

    var deleteButtons = document.querySelectorAll('.delete-redirect');
    function resetDeleteButtons() {
        var deleteButtons = document.querySelectorAll('.delete-redirect');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                deleteRedirectButton(button);
            });
        });
    }
    resetDeleteButtons();

    var editButtons = document.querySelectorAll('.edit-redirect');
    function resetEditButtons() {
        var editButtons = document.querySelectorAll('.edit-redirect');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                redirectModalIdInput.value = button.getAttribute('data-id');
                redirectModalNameInput.value = button.getAttribute('data-name');
                redirectModalTargetInput.value = button.getAttribute('data-target');
                redirectModalUrlInput.value = button.getAttribute('data-url');

                for (let i = 0; i < redirectModalCodeInput.options.length; i++) {
                    if (redirectModalCodeInput.options[i].value == button.getAttribute('data-code')) {
                        notes.selectedIndex = i;
                    }
                }

                redirectModal.classList.remove('hidden');
            });
        });
    }
    resetEditButtons();

    var redirectToken = redirectModal.querySelector('input[name=_token]');

    addRedirectButton.addEventListener('click', function() {
        redirectModal.classList.remove('hidden');
    });

    redirectModalClose.addEventListener('click', function() {
        updateRedirect(redirectModalIdInput.value, redirectModalNameInput.value, redirectModalTargetInput.value, redirectModalCodeInput.value).then(function(object) {
            redirectModalIdInput.value = object.id;
            redirectModalNameInput.value = object.name;
            redirectModalTargetInput.value = object.target;
            redirectModalCodeInput.value = object.code;
            redirectModalUrlInput.value = object.url;
        });;
        redirectModal.classList.add('hidden');
    });

    redirectModalCloseCopy.addEventListener('click', function() {
        updateRedirect(redirectModalIdInput.value, redirectModalNameInput.value, redirectModalTargetInput.value, redirectModalCodeInput.value).then(function(object) {
            redirectModalIdInput.value = object.id;
            redirectModalNameInput.value = object.name;
            redirectModalTargetInput.value = object.target;
            redirectModalCodeInput.value = object.code;
            redirectModalUrlInput.value = object.url;

            if (redirectModalUrlInput.value != "") {
                copyText(redirectModalUrlInput.value);
            }
        });;
        redirectModal.classList.add('hidden');
    });

    function deleteRedirectButton(button) {
        console.log('delete');
        deleteRedirect(button.getAttribute('data-id')).then(function(object) {
            if (object == 1) {
                button.parentElement.remove();
            }
        });
    }

    function deleteRedirect(id) {
        return new Promise(function(resolve, reject) {
            const data = [
                { key: 'id', value: id },
            ];

            const params = new URLSearchParams();
            data.forEach(item => {
                params.append(item.key, item.value);
            });

            var response = fetch('/privater-bereich/weiterleitungen/delete', {
                method: 'POST',
                body: params,
                headers: {
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                }
            }).then(function(response) {
                response.json().then(function (object) {
                    resolve(object);
                });
            });
        });
    }

    function updateRedirect(id, name, target, code) {
        return new Promise(function(resolve, reject) {
            const data = [
                { key: 'id', value: id },
                { key: 'name', value: name },
                { key: 'target', value: target },
                { key: 'code', value: code},
            ];

            const params = new URLSearchParams();
            data.forEach(item => {
                params.append(item.key, item.value);
            });

            var response = fetch('/privater-bereich/weiterleitungen/push', {
                method: 'POST',
                body: params,
                headers: {
                    "X-CSRF-Token": document.querySelector('input[name=_token]').value
                }
            }).then(function(response) {
                response.json().then(function (object) {
                    resolve(object);
                });
            });
        });

    }


});
