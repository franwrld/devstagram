import Dropzone from "dropzone";

Dropzone.autoDiscover = false;


const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFiles: 1,
    uploadMultiple: false,
    //Si hay una imagen en el dropzone que la mantenga
    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call( this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
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
// Si el usuario elimina desde el dropzone la imagen que no se quede guardado en el value del input imagen que al eliminarlo vuelva a vacio
dropzone.on('removedfile', function() {
    document.querySelector('[name="imagen"]').value = '';
});