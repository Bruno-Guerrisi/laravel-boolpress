// dipendenze
import Vue from 'vue';
import VueRouter from 'vue-router';

// componenti
import Home from './pages/Home';
import About from './pages/About';

// attivazione
Vue.use(VueRouter);

// definizione rotte
const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [

        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/about',
            name: 'about',
            component: About,
        },
    ],
});

// esportazione delle rotte
export default router;