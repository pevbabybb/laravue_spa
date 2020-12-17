import Vue from 'vue';
import Home from './Home.vue';
import Task from './Task.vue';
import store from './store';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap';


import BootstrapVue from 'bootstrap-vue';
import FlashMessage from '@smartweb/vue-flash-message';

Vue.use(FlashMessage);
Vue.use(BootstrapVue);
 new Vue({
    el: '#app',
    store,
    render: h => h(Home)

});

new Vue({
    el:'#display',
    store,
    render: h=> h(Task)

});


Vue.config.productionTip = false