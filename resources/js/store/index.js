import Vue from 'vue';
import Vuex from 'vuex';
import Notifications from 'vue-notification';
import VModal from 'vue-js-modal';
import Vuelidate from 'vuelidate';

import actions from './actions';
import mutations from './mutations';
import getters from './getters';
import state from "./state";


Vue.use(Vuex);
Vue.use(Notifications);
Vue.use(VModal, { dialog: true });
Vue.use(Vuelidate);

export default new Vuex.Store({
    state,
    mutations,
    getters,
    actions,
    strict: true
});