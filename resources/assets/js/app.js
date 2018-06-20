import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App/App.vue';
// import BootstrapVue from 'bootstrap-vue';
import 'es6-promise/auto';
import Vuex from 'vuex';

import Index from './components/index/Index.vue';
// import Home from './components/Home.vue';
import Register from './components/register/Register.vue';
import Login from './components/login/Login.vue';
import ExampleComponent from './components/ExampleComponent.vue';
import { store } from './vuex/store'
import Profile from './components/profile/Profile.vue';
import Editprofile from './components/editprofile/Editprofile.vue';
import Forgetpassword from './components/forgetpassword/Forgetpassword.vue'
import Resetpassword from './components/forgetpassword/Resetpassword.vue';

// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

import Vuikit from 'vuikit';
import VuikitIcons from '@vuikit/icons';

import '@vuikit/theme';

Vue.use(Vuikit);
Vue.use(VuikitIcons);

Vue.use(VueRouter);
// Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
Vue.use(Vuex);

axios.defaults.baseURL = 'http://localhost:8000/api';

const router = new VueRouter({
  routes: [
    {
      path: '/',
      name: 'index',
      component: Index,
      meta: {
        auth: false
      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        auth: false
      }
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        auth: false
      }
    },
    {
      path: '/ex',
      name: 'example',
      component: ExampleComponent,
      meta: {
        auth: true
      }
    },
    {
      path: '/profile',
      name: 'profile',
      component: Profile,
      meta: {
        auth: false
      }
    },
    {
      path: '/editprofile',
      name: 'editprofile',
      component: Editprofile,
      meta: {
        auth: false
      }
    },
    {
      path: '/forgetpassword',
      name: 'forgetpassword',
      component: Forgetpassword,
      meta: {
        auth: false
      }
    },
    {
      path: '/resetpassword',
      name: 'resetpassword',
      component: Resetpassword,
      meta: {
        auth: false
      }
    }
  ]
});

Vue.router = router

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
})

App.router = Vue.router

new Vue({
  el: '#app',
  store: store,
  render: h => h(App)
});
