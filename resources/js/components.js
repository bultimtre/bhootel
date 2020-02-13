window.Vue = require('vue');

//components vue
Vue.component(
    'adv-search', require('./components/AdvanceSearch.vue')
);

function init() {
    const app = new Vue({
        el: '#app',
    });
}
$(function() {
    init();
})


