import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App/App.vue';
import BootstrapVue from 'bootstrap-vue'

import Index from './components/index/Index.vue';
// import Home from './components/Home.vue';
import Register from './components/register/Register.vue';
import Login from './components/login/Login.vue';
import ExampleComponent from './components/ExampleComponent.vue';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);

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

new Vue(App).$mount('#app');
