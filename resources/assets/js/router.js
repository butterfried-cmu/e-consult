import VueRouter from "vue-router/types/index";

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
            component: EditProfile,
            meta: {
                auth: false
            }
        },
        {
            path: '/forgetpassword',
            name: 'forgetpassword',
            component: ForgetPassword,
            meta: {
                auth: false
            }
        },
        {
            path: '/resetpassword',
            name: 'resetpassword',
            component: ResetPassword,
            meta: {
                auth: false
            }
        }
    ]
});

router.beforeResolve((to, from, next) => {
    // If this isn't an initial page load.
    if (to.name) {
        // Start the route progress bar.
        NProgress.start()
    }
    next()
})

router.afterEach((to, from) => {
    // Complete the animation of the route progress bar.
    NProgress.done()
})

module.exports = [
    {
        path: '/',
        component: require('../components/Home/home.vue'),
        meta: {
            title: 'Home'
        }
]