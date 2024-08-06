export function copyText(text) {
    var tempInput = document.createElement("textarea");
    tempInput.value = text;

    // Ensure the text area is not visible and off the screen
    tempInput.style.position = 'fixed';  // Prevents scrolling to bottom of page in MS Edge.
    tempInput.style.left = '-9999px';
    tempInput.style.top = '0';
    document.body.appendChild(tempInput);

    // Select the text
    tempInput.focus();
    tempInput.select();

    // Attempt to use the Clipboard API
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function () {
            console.log('Text copied to clipboard successfully!');
        }).catch(function (err) {
            console.error('Failed to copy the text: ', err);
            // Fallback to execCommand if Clipboard API fails
            document.execCommand('copy');
        });
    } else {
        // Fallback to execCommand for older browsers
        try {
            document.execCommand('copy');
            console.log('Text copied to clipboard using execCommand!');
        } catch (err) {
            console.error('Failed to copy the text using execCommand: ', err);
        }
    }

    // Clean up
    document.body.removeChild(tempInput);
}

