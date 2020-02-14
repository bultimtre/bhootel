window.Vue = require('vue');
Vue.component('adv-search', require('./components/AdvanceSearch.vue').default);
const app = new Vue({
    el: '#app',
});

