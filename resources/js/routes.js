// dipendenze
import Vue from 'vue';
import VueRouter from 'vue-router';

// componenti
import Home from './pages/Home';
import About from './pages/About';
import Blog from './pages/Blog';
import PostDetail from './pages/PostDetail';
import NotFound from './pages/NotFound';

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
        {
            path: '/blog',
            name: 'blog',
            component: Blog,
        },
        {
            path: '/blog/:slug',
            name: 'post-detail',
            component: PostDetail,
        },
        {
            path: '*',
            name: 'not_found',
            component: NotFound,
        },
    ],
});

// esportazione delle rotte
export default router;