export function copyText(text) {
    var tempInput = document.createElement("input");
    tempInput.setAttribute("type", "text");
    tempInput.setAttribute("value", text);
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // For mobile devices

    try {
        // Try using the Clipboard API
        navigator.clipboard.writeText(tempInput.value).then(function () {
            console.log('URL copied to clipboard successfully!');
        }, function (err) {
            console.error('Failed to copy the URL: ', err);
        });
    } catch (err) {
        // Fallback to document.execCommand
        console.warn('Using document.execCommand as fallback');
        document.execCommand('copy');
    }

    document.body.removeChild(tempInput);
}