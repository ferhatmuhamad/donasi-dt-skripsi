import axios from 'axios';
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

    async validateUser() {
      await axios.get(process.env.VUE_APP_API + 'profile', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).catch(() => {
        localStorage.removeItem('token');
      })
    }
  },
  actions: {
  },
  modules: {
  }
})
