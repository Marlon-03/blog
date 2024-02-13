import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
      isAuthenticated: false,
      role: null, // 'user' or 'contributor'
    },
    mutations: {
      SET_AUTHENTICATED(state, value) {
        state.isAuthenticated = value;
      },
      SET_ROLE(state, role) {
        state.role = role;
      },
    },
  });