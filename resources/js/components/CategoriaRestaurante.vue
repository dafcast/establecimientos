<template>
    <div class="container mt-5">
        <h2>Categoria Restaurantes</h2>
        <div class="row">
            <div class="col-md-4" v-for="restaurante in restaurantes" :key="restaurante.id">
                <div class="card">
                    <img class="card-image-top" :src="`/storage/${restaurante.imagen_principal}`">
                    <div class="card-body">
                        <h4 class="card-title">{{ restaurante.nombre }}</h4>
                        <div class="card-text">{{ restaurante.direccion}}</div>
                        <div class="card-text">
                            <span class="font-weight-bold">Horario:</span>
                            {{ restaurante.apertura }} - {{ restaurante.cierre }}
                        </div>
                        <router-link :to="{name: 'establecimiento', params: {id: restaurante.id}}">
                            <a href="" class="btn btn-primary mt-2">Ver establecimiento</a>
                        </router-link>
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
            // restaurantes: []
        }
    },
    mounted(){
        axios.get('/api/categorias/restaurante')
            .then((response) => {
                this.$store.commit('AGREGAR_RESTAURANTES',response.data);
            })
    },
    computed:{
        restaurantes(){
            return this.$store.state.restaurantes
        }
    }
}
</script>