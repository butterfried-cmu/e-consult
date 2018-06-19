import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
  state: {
    user: {
      username: 'test',
      jwt: ''
    }
  },
  getters: {
    currentUser(state){
      return state.user;
    }
  }
})
