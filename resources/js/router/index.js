import Vue from 'vue'
import VueRouter from 'vue-router'

import InicioEstablecimientos from '../components/InicioEstablecimientos'
import Establecimiento from '../components/Establecimiento'

const routes = [
    {
        path: '/',
        component: InicioEstablecimientos
    },
    {
        path: '/establecimientos/:id',
        name: 'establecimiento',
        component: Establecimiento
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
});


Vue.use(VueRouter)


export default router;