import _ from "lodash"

function generateSessionId() {
    return Math.floor(10000 + Math.random() * 90000).toString();
}

if (!localStorage.getItem('sessionId')) {
    localStorage.setItem('sessionId', generateSessionId());
}

let ws = new WebSocket("ws://localhost:3000/");
console.log("Session ID:", localStorage.getItem('sessionId'));
window.ws = ws;

var shareWrapper = document.querySelector(".share-wrapper")

ws.onopen = () => {
    const msg = {
        type: "join",
        payload: localStorage.getItem('sessionId')
    };
    ws.send(JSON.stringify(msg) + "\n");


    window.addEventListener("beforeunload", function (e) {
        const msg = {
            type: "leave",
            payload: localStorage.getItem('sessionId')
        };
        ws.send(JSON.stringify(msg) + "\n");
    });

    window.sendText = (userID, text) => {
        const msg = {
            type: "sendText",
            payload: userID,
            text: text
        };
        ws.send(JSON.stringify(msg) + "\n");
    }
};

var users = [];
ws.onmessage = (event) => {
    let jEvent = JSON.parse(event.data);

    if (jEvent.type == "join" && jEvent.status == "ok") {
        window.users = JSON.parse(jEvent.data);
        updateUserList();
    }

    if (jEvent.type == "join" && jEvent.status == "userJoin") {
        let userID = jEvent.data;
        if (!window.users.includes(userID)) {
            window.users.push(userID);
            updateUserList();
        }
    }

    if (jEvent.type == "leave" && jEvent.status == "userLeft") {
        let userID = jEvent.data;
        window.users = window.users.filter(user => user !== userID);
        updateUserList();
    }

    if (jEvent.type == "sendText" && jEvent.status == "dataSend") {
        alert(jEvent.data);
    }

    if (jEvent.type == "sendFile" && jEvent.status == "requestSendFile") {
        if (confirm("Accept File " + jEvent.filename + " from " + jEvent.data)) {
            const msg = {
                type: "acceptFile",
                payload: jEvent.data,
            };
            ws.send(JSON.stringify(msg) + "\n");
        } else {
            const msg = {
                type: "denyFile",
                payload: jEvent.data,
            };
            ws.send(JSON.stringify(msg) + "\n");
        }
    }

    if (jEvent.type === "sendFile" && jEvent.status === "dataSend") {
        const filename = jEvent.filename;
        const base64 = jEvent.bytes;

        // Convert base64 to binary
        const binary = atob(base64);
        const bytes = new Uint8Array(binary.length);
        for (let i = 0; i < binary.length; i++) {
            bytes[i] = binary.charCodeAt(i);
        }

        // Create a Blob and download link
        const blob = new Blob([bytes]);
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }


    console.log(jEvent);
};

window.users = users

function updateUserList() {
    shareWrapper.innerHTML = ''; // Clear existing content

    const templateHtml = document.getElementById('user-template').innerHTML;
    const compiled = _.template(templateHtml);

    window.users.forEach(userID => {
        const html = compiled({ userID: userID, current: userID == localStorage.getItem('sessionId') });
        shareWrapper.insertAdjacentHTML('beforeend', html);
    });

    shareWrapper.querySelectorAll('.user-block').forEach(block => {
        const userID = block.dataset.userid;

        // Text send
        const input = block.querySelector('.user-input');
        const button = block.querySelector('.send-btn');
        button.addEventListener('click', () => {
            const text = input.value.trim();
            if (text) {
                window.sendText(userID, text);
                input.value = '';
            }
        });

        // File send
        const fileInput = block.querySelector('.file-input');
        const fileBtn = block.querySelector('.file-send-btn');
        fileBtn.addEventListener('click', () => {
            const file = fileInput.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function () {
                const arrayBuffer = reader.result;
                const bytes = Array.from(new Uint8Array(arrayBuffer));

                const msg = {
                    type: "sendFile",
                    payload: userID,
                    filename: file.name,
                    bytes: bytes
                };
                ws.send(JSON.stringify(msg) + "\n");
            };
            reader.readAsArrayBuffer(file);
        });
    });
}
