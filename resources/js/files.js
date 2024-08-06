import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#files-dropzone", {
  paramName: 'file', // The name that will be used to transfer the file
  maxFilesize: 200, // MB
  parallelUploads: 10,
  addRemoveLinks: true,
  dictRemoveFile: 'Remove',
  init: function() {
    this.on("success", function(file, response) {
      console.log("File uploaded successfully");
    });
    this.on("error", function(file, response) {
      console.error("File upload error:", response);
    });
  }
});

