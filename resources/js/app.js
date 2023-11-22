import './bootstrap';
import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;
let dropzone = null;

if(document.querySelector('#dropzone')){
    dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Sube aquí tu imagen',
        acceptedFiles: '.png, .jpg, .jpeg, .gif',
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar Archivo',
        maxFiles: 1,
        uploadMultiple: false,

        init: function() {
            const image = document.querySelector('[name="image"]').value;
            if(image.trim()){
                const imagePublished = {
                    size: 123,
                    name: image,
                };

                this.options.addedfile.call(this, imagePublished);
                this.options.thumbnail.call(this, imagePublished, `/uploads/${imagePublished.name}`)

                imagePublished.previewElement.classList.add(
                    "dz.success",
                    "dz-complete"
                )
            }
        }
    })
}

dropzone && dropzone.on('sending', function( file, xhr, formData ){
    //console.log(file);
})

dropzone && dropzone.on('success', function( file, response ){
    document.querySelector('[name="image"]').value = response
})

dropzone && dropzone.on('error', function( file, message ){
    //console.log(message);
})

dropzone && dropzone.on('removedfile', function(){
    document.querySelector('[name="image"]').value = '';
})

const inputImg = document.querySelector('#image');

inputImg && inputImg.addEventListener("change", (event) => {
    const [file] = inputImg.files;
    const showImg = document.querySelector('#showImg');

    if (file && showImg) {
        showImg.src = URL.createObjectURL(file);
    }
})
