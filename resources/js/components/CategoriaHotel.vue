<template>
    <div class="container mt-5">
        <h2>Categoria Hoteles</h2>
        <div class="row">
            <div class="col-md-4" v-for="hotel in hoteles" :key="hotel.id">
                <div class="card">
                    <img class="card-image-top" :src="`/storage/${hotel.imagen_principal}`">
                    <div class="card-body">
                        <h4 class="card-title">{{ hotel.nombre }}</h4>
                        <div class="card-text">{{ hotel.direccion}}</div>
                        <div class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{ hotel.apertura }} - {{ hotel.cierre }}
                        </div>
                        <a href="" class="btn btn-primary mt-2">Ver establecimiento</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function(){
        return {
            // hoteles: []
        }
    },
    mounted(){
        axios.get('/api/categorias/hotel')
            .then((response) => {
                this.$store.commit('AGREGAR_HOTELES',response.data);
            })
    },
    computed:{
        hoteles(){
            return this.$store.state.hoteles;
        }
    }
}
</script>