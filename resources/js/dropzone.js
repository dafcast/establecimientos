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
            success: function(file,response){
                // console.log(file);
                file.imagen_id = response.imagen_id;
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
                axios.delete(`/imagenes/${file.imagen_id}`)
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