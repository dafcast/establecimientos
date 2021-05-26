const { default: Axios } = require("axios");

document.addEventListener('DOMContentLoaded', () =>{
    if(document.querySelector('#dropzone')){
        // Disable auto discover for all elements:
        Dropzone.autoDiscover = false;

        // Dropzone class:
        // console.log(document.querySelector("meta[name='csrf-token']").content);
        var myDropzone = new Dropzone("div#dropzone",{
            url: "/imagenes/store",
            headers: {
                'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").content
            },
            maxFiles: 10,
            acceptedFiles: ".jpg, .png, .bmp, .jpeg, .gif",
            dictDefaultMessage: "Cargue sus archivos aqui",
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar imagen',
            init: function() {
                const galeria = document.querySelectorAll('.galeria')

                if(galeria.length > 0){
                    galeria.forEach(imagen => {
                        
                        const imagenPublicada ={};
                        imagenPublicada.size = 1;
                        imagenPublicada.name = imagen.value;
                        imagenPublicada.ruta_imagen = imagen.value;

                        this.options.addedfile.call(this,imagenPublicada);
                        this.options.thumbnail.call(this,imagenPublicada,`/storage/${imagenPublicada.name}`);


                        imagenPublicada.previewElement.classList.add('dz-success');
                        imagenPublicada.previewElement.classList.add('dz-complete');

                    })
                }
            },
            success: function(file,response){
                // console.log(file);
                file.ruta_imagen = response.ruta_imagen;
                // console.log(file.ruta_imagen);
                // console.log(response);
            },
            error: function(file,message,xhr){
                // console.log(file);
                // console.log(message);
            },
            sending: function(file, xhr, formData){
                formData.append('uuid', document.querySelector('#uuid').value)
            },
            removedfile: function(file) {
                // console.log(file);
                // const params = {
                //     imagen_id: file.imagen_id
                // };
                const params = {
                    ruta_imagen: file.ruta_imagen
                }
                axios.post(`/imagenes/destroy`, params)
                    .then( (response) => {
                        // console.log(response);
                        file.previewElement.parentNode.removeChild(file.previewElement);
                    })
                    .catch( (error) =>{
                        // console.log(error);
                    });
            }

        });
    }
    
});