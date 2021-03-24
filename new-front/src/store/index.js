import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

import session from './modules/session'
import basket from "./modules/basket";

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        session,
        basket
    },
    state: {},
    actions: {},
    mutations: {},
    getters: {},
    plugins: [
        createPersistedState()
    ]
})
