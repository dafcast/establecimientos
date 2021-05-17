<template>
    <div class="container mt-5">
        <h2>Categoria Cafés</h2>
        <div class="row">
            <div class="col-md-4" v-for="cafe in cafes" :key="cafe.id">
                <div class="card">
                    <img class="card-image-top" :src="`/storage/${cafe.imagen_principal}`">
                    <div class="card-body">
                        <h4 class="card-title">{{ cafe.nombre }}</h4>
                        <div class="card-text">{{ cafe.direccion}}</div>
                        <div class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{ cafe.apertura }} - {{ cafe.cierre }}
                        </div>
                        <router-link :to="{name: 'establecimiento', params: {id: cafe.id}}" class="btn btn-primary mt-2">Ver establecimiento</router-link>
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
            // cafes: []
        }
    },
    mounted(){
        axios.get('/api/categorias/cafe')
            .then((response) => {
                this.$store.commit('AGREGAR_CAFES', response.data);
            })
    },
    computed:{
        cafes(){
            return this.$store.state.cafes;
        }
    }
}
</script>