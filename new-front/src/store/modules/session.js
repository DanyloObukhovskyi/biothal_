const state = {
    token: null
}

const mutations = {
    SET_TOKEN(state, token) {
        state.token = token;
    }
}

const actions = {
    LOGIN(context, data) {
        const token = 'test-token'
        context.commit('SET_TOKEN', token);
    }
}

const getters = {
    getToken: state => state.token
}

export default {
    state,
    mutations,
    getters,
    actions
}
