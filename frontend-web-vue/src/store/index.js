// import axios from 'axios';
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: null
  },
  mutations: {
    logout() {
      localStorage.removeItem('token');
      this.$router.push('/');
    },

    login(state, tokenfromviews) {
      localStorage.setItem('token', tokenfromviews);
    },

    validateUser() {
      // axios.post(process.env.VUE_APP_API + )
    }
  },
  actions: {
  },
  modules: {
  }
})
