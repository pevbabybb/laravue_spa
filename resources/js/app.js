import Vue from 'vue';
import Home from './Home.vue';
import Task from './Task.vue';
import store from './store';
import VueSocketIO from 'vue-socket.io';
import socketio from 'socket.io-client';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap';


import BootstrapVue from 'bootstrap-vue';
import FlashMessage from '@smartweb/vue-flash-message';



Vue.use(FlashMessage);
// Vue.use(new VueSocketIO({
//     debug: true,
//     connection: 'http://localhost:6001',
//     vuex: {
//         store,
//         actionPrefix: 'SOCKET_',
//         mutationPrefix: 'SOCKET_'
//     },
//    // options: { path: "/my-app/" } //Optional options
// }));

// Vue.use(VueSocketIO,socketio(':6001'));
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