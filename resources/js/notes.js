document.addEventListener('DOMContentLoaded', function() {
    // <select
    var notes = document.querySelector('#notes');
    // <textarea
    var note = document.querySelector('#note');
    // <button
    var addButton = document.querySelector('#add-note');
    // <button
    var deleteButton = document.querySelector('#delete-note');
    // <input type="text"
    var noteName = document.querySelector('#note-name')

    var activeNote = -1;

    addButton.addEventListener('click', function() {
        notes.options[notes.options.length] = new Option('Neue Notiz', -2);
        notes.selectedIndex = notes.options.length - 1;
        activeNote = -2;
        displayNoteContent();
    });

    notes.addEventListener('change', function() {
        activeNote = notes.value;
        displayNoteContent() ?? '';
    });

    note.addEventListener('change', function() {
        updateNote();
    });

    noteName.addEventListener('change', function() {
        updateNote();
    })

    deleteButton.addEventListener('click', function() {
        deleteNote();
    });

    function init() {
        activeNote = notes.options[0].value;
        displayNoteContent() ?? '';
    }

    function deleteNote() {
        var response = fetch('/privater-bereich/notizen/delete/' + activeNote, {
            method: 'POST',
            headers: {
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            }
        }).then(function(response) {
            response.json().then(function (object) {
                notes.options[activeNote] = null;
                notes.options.length--;
                notes.selectedIndex = 0;
                activeNote = notes.value;
                displayNoteContent();
            });
        });
    }

    function displayNoteContent() {
        var response = fetch('/privater-bereich/notizen/get/' + activeNote, {
            method: 'GET',
            headers: {
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            }
        }).then(function(response) {
            response.json().then(function (object) {
                note.value = object.content;
                noteName.value = object.name;
            });
        });
    }

    function updateNote() {
        const data = [
            { key: 'content', value: note.value },
            { key: 'name', value: noteName.value }
        ];

        const activeNoteIndex = notes.selectedIndex;
        const activeNoteValue = notes.value;

        const params = new URLSearchParams();
        data.forEach(item => {
            params.append(item.key, item.value);
        });

        var response = fetch('/privater-bereich/notizen/update/' + activeNote, {
            method: 'POST',
            body: params,
            headers: {
                "X-CSRF-Token": document.querySelector('input[name=_token]').value
            }
        }).then(function(response) {
            response.json().then(function (object) {
                if (activeNoteValue == -2 || activeNoteValue == -1) {
                    // New note, update the placeholder option
                    notes.options[activeNoteIndex].value = object.id;
                    notes.options[activeNoteIndex].innerText = object.name;
                } else {
                    // Existing note, find and update the option
                    for (let i = 0; i < notes.options.length; i++) {
                        if (notes.options[i].value == activeNoteValue) {
                            notes.options[i].value = object.id;
                            notes.options[i].innerText = object.name;
                            break;
                        }
                    }
                }
                activeNote = object.id;
            });
        });
    }
    init();
});
