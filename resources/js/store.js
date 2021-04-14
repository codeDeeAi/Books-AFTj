import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({

    state: {
        token: localStorage.token,
    },
    getters: {
        getToken(state) {
            return state.token
        },
    },
    mutations: {},
    actions: {

    }
})