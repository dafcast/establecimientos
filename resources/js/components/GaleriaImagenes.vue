<template>
    <div>
        <h1>Galeria de Imagenes</h1>

        <ul class="row list-unstyled mt-4">
            <li v-for="imagen in imagenes" v-bind:key="imagen.id" class="col-md-4 mt-4">
                <a :href="`/storage/${imagen.ruta_imagen}`" class="img-fluid" data-lightbox="imagen" data-title="Imagen establecimiento">
                    <img :src="`/storage/${imagen.ruta_imagen}`" class="img-fluid">
                </a>
            </li>
        </ul>

    </div>
</template>
<script>
import Lightbox from 'lightbox2'
export default {
    computed:{
        imagenes(){
            return this.$store.getters.obtenerImagenes;
        }
    }
}
</script>
<style scoped>
    @import 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css';
</style>