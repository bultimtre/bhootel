require('./bootstrap');
window.Vue = require('vue');

//components vue
Vue.component('AdvanceSearch', require('./components/AdvanceSearch.vue').default);

const app = new Vue({
    el: '#app',
});
