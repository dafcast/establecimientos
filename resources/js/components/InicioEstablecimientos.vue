<template>
<div>
    <listado-categorias></listado-categorias>
    <mapa-establecimientos></mapa-establecimientos>
    <categoria-cafe></categoria-cafe>
    <categoria-restaurante></categoria-restaurante>
    <categoria-hotel></categoria-hotel>
</div>
</template>
<script>
import CategoriaCafe from './CategoriaCafe';
import CategoriaRestaurante from './CategoriaRestaurante';
import CategoriaHotel from './CategoriaHotel';
import MapaEstablecimientos from './MapaEstablecimientos';
import ListadoCategorias from './ListadoCategorias';

export default {
    components:{
        CategoriaCafe,
        CategoriaRestaurante,
        CategoriaHotel,
        MapaEstablecimientos,
        ListadoCategorias
    }
}
</script>