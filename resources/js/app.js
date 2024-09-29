import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Subir imagen Aqui",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar archivo",
    maxFiles: 1,
    uploadMultiple: false, 

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imagePublicada = {}
            imagePublicada.size = 12345;
            imagePublicada.name = document.querySelector('[name="image"]').value;
            this.options.addedfile.call(this, imagePublicada);
            this.options.thumbnail.call(this, imagePublicada, '/uploads/' + imagePublicada.name);
            imagePublicada.previewElement.classList.add("dz-success");
            imagePublicada.previewElement.classList.add("dz-complete");
        }
    }
});

dropzone.on("success", function (file, response) {
    document.querySelector('[name="image"]').value = response.image;
})

dropzone.on("removedfile", function () {
    document.querySelector('[name="image"]').value = '';
})
