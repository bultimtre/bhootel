window.Vue = require('vue');
import axios from 'axios';
import VueAxios from 'vue-axios';
import Main from './components/main.vue';
import Router from './routes';
Vue.use(VueAxios,axios)
Vue.component('main-vue', Main);
 const app = new Vue({
     el: '#app',
     router: Router,
 });




