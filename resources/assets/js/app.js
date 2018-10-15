import Vue from 'vue';
import VueRouter from 'vue-router';
import axios from 'axios';
import VueAxios from 'vue-axios';
import App from './App/App.vue';
// import BootstrapVue from 'bootstrap-vue';
import 'es6-promise/auto';
import Vuex from 'vuex';

import Index from './components/index/Index.vue';
import AddUser from './components/user/add/user-add.vue';
import Login from './components/user/login/Login.vue';
import { store } from './vuex/store';
import Profile from './components/user/profile/user-profile.vue';
import ViewUser from './components/user/view/user-view.vue';
import EditProfile from './components/user/edit/user-edit.vue';
import ForgetPassword from './components/user/forgetpassword/Forgetpassword.vue';
import ResetPassword from './components/user/forgetpassword/Resetpassword.vue';
import NotFoundComponent from './components/not-found-component/not-found-component.vue';
import UserList from './components/user/list/user-list.vue';

import ConsultAdd from './components/consult/add/consult-add.vue';
import ConsultView from './components/consult/view/consult-view.vue';
import ConsultList from './components/consult/list/consult-list.vue';
import ConsultEdit from './components/consult/edit/consult-edit.vue';
import Message from './components/message/send/message.vue';
import Reply from './components/message/order/reply.vue';

// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'


import Vuikit from 'vuikit';
import VuikitIcons from '@vuikit/icons';

import '@vuikit/theme';
import VuePaginate from 'vue-paginate'
Vue.use(VuePaginate);

Vue.use(Vuikit);
Vue.use(VuikitIcons);

Vue.use(VueRouter);
// Vue.use(BootstrapVue);
Vue.use(VueAxios, axios);
Vue.use(Vuex);


axios.defaults.baseURL = 'http://localhost:8000/api';
// axios.defaults.baseURL = 'http://2012b965.ngrok.io/api';

const ifNotLoggedIn = (to, from, next) => {
    if (!store.getters['isLoggedIn']) {
        next()
        return
    }
    next('/')
}

const ifLoggedIn = (to, from, next) => {
    if (store.getters['isLoggedIn']) {
        next()
        return
    }
    next('/login')
}
const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index,
            beforeEnter: ifLoggedIn,
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            // beforeEnter: ifNotLoggedIn,
        },
        {
            path: '/add',
            name: 'add-user',
            component: AddUser,
            // beforeEnter: ifLoggedIn,
        },
        {
            path: '/users/:id',
            name: 'user',
            component: ViewUser
        },
        {
            path: '/profile/edit/:id',
            name: 'editprofile',
            component: EditProfile,
            // beforeEnter: ifLoggedIn,
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            // beforeEnter: ifLoggedIn,
        },
        {
            path: '/forgetpassword',
            name: 'forgetpassword',
            component: ForgetPassword,
            // beforeEnter: ifLoggedIn,
        },
        {
            path: '/password-reset',
            name: 'resetpassword',
            component: ResetPassword,
            // beforeEnter: ifLoggedIn,
        },
        {
            path: '/users',
            name: 'user-list',
            component: UserList
        },
        {
            path: '/consult-add',
            name: 'consult-add',
            component: ConsultAdd
        },
        {
            path: '/message',
            name: 'message',
            component: Message
        },
        {
            path: '/consult-view',
            name: 'consult-view',
            component: ConsultView
        },
        {
            path: '/consult-list',
            name: 'consult-list',
            component: ConsultList
        },
        {
            path: '/consult-edit',
            name: 'consult-edit',
            component: ConsultEdit
        },
        {
            path: '/reply',
            name: 'reply',
            component: Reply
        },
        {
            path: '*',
            name: 'not-found-component',
            component: NotFoundComponent
        },
    ]
});

Vue.router = router;

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
