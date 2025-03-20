import Dropzone from "dropzone";

Dropzone.autoDiscover = false;


const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false
});
//Debug
//dropzone.on('sending', function(file, xhr, formData) {
    //console.log(file);
//});

dropzone.on('success', function(file, response) {
    //console.log(response.imagen);
    //asignar el nombre de la imagen 10293012390.jpg al input de create post
    document.querySelector('[name="imagen"]').value = response.imagen;
});
//dropzone.on('error', function(file, message) {
    //console.log(message);
//});
dropzone.on('removedFile', function() {
    console.log("Archivo Eliminado");
});