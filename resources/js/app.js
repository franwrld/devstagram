import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

document.addEventListener('DOMContentLoaded', () => {
    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Sube aqui tu imagen',
        acceptedFiles: ".png, .jpg, .jpeg, .gif",
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar Archivo',
        maxFiles: 1,
        uploadMultiple: false
    });
});
