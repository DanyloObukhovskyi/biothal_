import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

import session from './modules/session'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        session
    },
    state: {},
    actions: {},
    mutations: {},
    getters: {},
    plugins: [
        createPersistedState()
    ]
})
