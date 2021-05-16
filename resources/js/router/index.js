import Vue from 'vue'
import VueRouter from 'vue-router'

import InicioEstablecimientos from '../components/InicioEstablecimientos'

const routes = [
    {
        path: '/',
        component: InicioEstablecimientos
    }
];

const router = new VueRouter({
    routes
});


Vue.use(VueRouter)


export default router;