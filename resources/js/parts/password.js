export let enablePasswordCheck = null;
export let password = null;
export function enablePassword(passwordValue, checked) {
    if (!enablePasswordCheck || !password) {
        return;
    }
    enablePasswordCheck.checked = checked;
    enablePasswordCheck.dispatchEvent(new Event('change'));
    password.value = passwordValue;

    if (checked) {
        password.classList.remove('hidden');
        password.parentElement.classList.remove('hidden');
    } else {
        password.classList.add('hidden');
        password.parentElement.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    enablePasswordCheck = document.querySelector('#enable-password');
    password = document.querySelector('#password');

    enablePasswordCheck.addEventListener('change', function() {
        if (enablePasswordCheck.checked) {
            password.classList.remove('hidden');
            password.parentElement.classList.remove('hidden');
        } else {
            password.classList.add('hidden');
            password.parentElement.classList.add('hidden');
        }
    });
});


