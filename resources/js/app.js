import Vue from 'vue';
import Home from './Home.vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap';

import BootstrapVue from 'bootstrap-vue';
Vue.use(BootstrapVue);
 new Vue({
    el: '#app',
    render: h => h(Home)

});
