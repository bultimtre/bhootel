import Vue from 'vue';
import VueRouter from 'vue-router';

import Index from './components/bh-index.vue'
import Login from './components/bh-login.vue'
Vue.use(VueRouter);

const router = new VueRouter({
    routes:[
        {
            name:'index',
            path:'/',
            component:Index
        },
        {
            name:'login',
            path:'/login',
            component:Login
        }

    ]
})

export default router
