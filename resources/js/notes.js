import {
  enablePasswordCheck,
  password,
  enablePassword,
} from "./parts/password.js";
import { copyText } from "./utils/clipboard.js";

document.addEventListener("DOMContentLoaded", function () {
  // <select
  var notes = document.querySelector("#notes");
  // <textarea
  var note = document.querySelector("#note");
  // <button
  var addButton = document.querySelector("#add-note");
  // <button
  var deleteButton = document.querySelector("#delete-note");
  // <input type="text"
  var noteName = document.querySelector("#note-name");
  var share = document.querySelector("#switch-share");

  var noteUrlButton = document.querySelector("#note-url-button");
  var shareModal = document.querySelector("#share-modal");
  var shareModalClose = shareModal.querySelector("#close");
  var shareModalCloseCopy = shareModal.querySelector("#close-copy");

  var loading = false;

  var activeNote = -1;

  addButton.addEventListener("click", function () {
    notes.options[notes.options.length] = new Option("Neue Notiz", -2);
    notes.selectedIndex = notes.options.length - 1;
    activeNote = -2;
    displayNoteContent();
  });

  notes.addEventListener("change", function () {
    activeNote = notes.value;
    setCookie("activeNote", activeNote, 2);
    displayNoteContent(true) ?? "";
  });

  note.addEventListener("change", function () {
    updateNote();
    setCookie("activeNote", activeNote, 2);
  });

  noteName.addEventListener("change", function () {
    updateNote();
  });

  share.addEventListener("change", function (item) {
    updateNote(true);
    if (share.checked) {
      noteUrlButton.classList.remove("hidden");
    } else {
      noteUrlButton.classList.add("hidden");
    }
  });

  deleteButton.addEventListener("click", function () {
    if (confirm("Sicher, dass du die Notiz löschen willst?")) {
      deleteNote();
    }
  });

  noteUrlButton.addEventListener("click", function () {
    if (!loading) {
      shareModal.classList.remove("hidden");
      if (note.dataset.enablepassword == 1) {
        enablePassword(note.dataset.password, true);
      } else {
        enablePassword(note.dataset.password, false);
      }
    }
  });

  shareModalClose.addEventListener("click", function () {
    shareModal.classList.add("hidden");
    updateNote(false, true);
  });

  shareModalCloseCopy.addEventListener("click", function () {
    updateNote(false, true);
    copyUrl();
    shareModal.classList.add("hidden");
  });

  function copyUrl() {
    let url = note.dataset.url;

    if (!url) {
      console.error("No URL found in dataset");
      return;
    }

    copyText(url);
  }

  function init() {
    activeNote = getCookie("activeNote")
      ? getCookie("activeNote")
      : notes.options[0].value;
    for (let i = 0; i < notes.options.length; i++) {
      if (notes.options[i].value == activeNote) {
        notes.selectedIndex = i;
      }
    }
    displayNoteContent() ?? "";
  }

  function deleteNote() {
    var response = fetch("/privater-bereich/notizen/delete/" + activeNote, {
      method: "POST",
      headers: {
        "X-CSRF-Token": document.querySelector("input[name=_token]").value,
      },
    }).then(function (response) {
      response.json().then(function (object) {
        notes.options[activeNote] = null;
        notes.options.length--;
        notes.selectedIndex = 0;
        activeNote = notes.value;
        displayNoteContent();
      });
    });
  }

  function displayNoteContent(activeLoading = false) {
    if (activeLoading) {
      loading = true;
    }
    var response = fetch("/privater-bereich/notizen/get/" + activeNote, {
      method: "GET",
      headers: {
        "X-CSRF-Token": document.querySelector("input[name=_token]").value,
      },
    }).then(function (response) {
      response.json().then(function (object) {
        note.value = object.content;
        noteName.value = object.name;
        if (object.share == 1) {
          share.checked = true;
          note.dataset.url = object.url;
          noteUrlButton.classList.remove("hidden");
        } else {
          share.checked = false;
          noteUrlButton.classList.add("hidden");
        }

        note.dataset.id = object.id;
        note.dataset.share = object.share;
        note.dataset.slug = object.slug;
        note.dataset.password = object.password;
        note.dataset.enablepassword = object.enable_password;

        loading = false;
      });
    });
  }

  function updateNote(CopyUrl = false, WritePassword = false) {
    const data = [
      { key: "content", value: note.value },
      { key: "name", value: noteName.value },
      { key: "share", value: share.checked ? 1 : 0 },
      { key: "enable-password", value: enablePasswordCheck.checked ? 1 : 0 },
      { key: "password", value: password.value },
      { key: "write-password", value: WritePassword ? 1 : 0 },
    ];

    const activeNoteIndex = notes.selectedIndex;
    const activeNoteValue = notes.value;

    const params = new URLSearchParams();
    data.forEach((item) => {
      params.append(item.key, item.value);
    });

    var response = fetch("/privater-bereich/notizen/update/" + activeNote, {
      method: "POST",
      body: params,
      headers: {
        "X-CSRF-Token": document.querySelector("input[name=_token]").value,
      },
    }).then(function (response) {
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

        note.dataset.id = object.id;
        note.dataset.url = object.url;
        note.dataset.share = object.share;
        note.dataset.slug = object.slug;
        note.dataset.password = object.password;
        note.dataset.enablepassword = object.enable_password;

        if (object.share == 1 && CopyUrl) {
          copyUrl();
        }

        activeNote = object.id;
        setCookie("activeNote", activeNote, 2);
      });
    });
  }
  function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }
  init();
});
