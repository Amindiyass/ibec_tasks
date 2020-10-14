require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import YardIndex from './components/YardComponent.vue';

const routes = [
    {
        path: '/',
        components: {
            YardIndex: YardIndex
        }
    },
]

const router = new VueRouter({routes})

const app = new Vue({router}).$mount('#app')
