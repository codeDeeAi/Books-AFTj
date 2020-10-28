import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({

    state: {
        counter: 1000,
        user: false,
        role: false,
        userPermissions: false,
    },
    getters: {
        getUserPermission(state) {
            return state.userPermissions
        }
    },
    mutations: {
        updateUser(state, data) {
            state.user = data
        },
        updateUserPermissions(state, data) {
            state.userPermissions = data
        },
        updateUserRole(state, data) {
            state.role = data
        },
    },
    actions: {

    }
})