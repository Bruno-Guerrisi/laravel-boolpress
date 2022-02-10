

import Vue from 'vue';
import App from './views/App';

// rotte per l'app
import router from './routes';


const root = new Vue( {
    el: '#root',
    router: router,
    render: h => h(App),
});