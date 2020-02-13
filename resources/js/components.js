window.Vue = require('vue');

//components vue
Vue.component(
    'adv-search', require('./components/AdvanceSearch.vue')
);

const app = new Vue({
    el: '#app',
});

