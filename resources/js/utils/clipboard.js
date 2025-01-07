export function copyText(text) {
    var tempInput = document.createElement("textarea");
    tempInput.value = text;

    // Ensure the text area is not visible and off the screen
    tempInput.style.position = "fixed"; // Prevents scrolling to bottom of page in MS Edge.
    tempInput.style.left = "-9999px";
    tempInput.style.top = "0";
    document.body.appendChild(tempInput);

    // Select the text
    tempInput.focus();
    tempInput.select();

    const translations = JSON.parse(
        document.querySelector('meta[name="translations-text"]').content,
    );

    // Attempt to use the Clipboard API
    if (navigator.clipboard) {
        navigator.clipboard
            .writeText(text)
            .then(function () {
                console.log(translations.copy_success);
                alert(translations.copy_success);
            })
            .catch(function (err) {
                console.error(translations.copy_failure, err);
                alert(translations.copy_failure);
                document.execCommand("copy");
            });
    } else {
        try {
            document.execCommand("copy");
            console.log(translations.fallback_copy_success);
            alert(translations.fallback_copy_success);
        } catch (err) {
            console.error(translations.fallback_copy_failure, err);
            alert(translations.fallback_copy_failure);
        }
    }
    // Clean up
    document.body.removeChild(tempInput);
}

document.addEventListener("livewire:navigated", updateCopyEventListeners);

function updateCopyEventListeners() {
    document.querySelectorAll('[data-copy="true"]').forEach(function (button) {
        button.removeEventListener("click", handleCopyButtonClick);
        button.addEventListener("click", handleCopyButtonClick);
    });
}

function handleCopyButtonClick(event) {
    var text = event.currentTarget.getAttribute("data-text");
    if (text) {
        copyText(text);
    } else {
        console.error("No text found to copy.");
    }
}
