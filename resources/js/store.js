import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state : {
        apiURL:'http://127.0.0.1:81/laravue_spa/public/api',
        serverPath:'http://127.0.0.1:81/laravue_spa/public'
    },
    mutations:{},
    action:{},
});