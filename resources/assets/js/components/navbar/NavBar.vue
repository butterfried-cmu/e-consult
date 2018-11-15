<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    // import { mapGetters } from 'vuex';

    export default {
        template: require('./navbar.html'),
        computed: {
            isLoggedIn() {
                return this.$store.getters['isLoggedIn'];
            },
            user() {
                return this.$store.getters['currentUser'];
            },
            role() {
                return this.$store.getters['userRole'];
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('logout');
                this.$router.push("login")
            },
            isRole(role) {
                for (var i = 0; i < this.$store.getters['userRole'].length; i++) {
                    if (role == this.$store.getters['userRole'][i]) return true;
                }
                return false;
                // return role === this.$store.getters['userRole'];
            }
        }
    }
</script>

<style scoped>
    .uk-button-default, .uk-button-default:focus, .uk-button-default:hover {
        border: none;
        padding: 0 15px
    } 
    @media (max-width: 768px) {
        .nav-bg {
            display: none;
        }
    }
    @media (min-width:769px) {
        .nav-medium {
            display: none;
        }
    }
    .nav-bg {
            background-color: #00203c!important;
            position: fixed;
            width: 100%;
            z-index: 100;
            top: 0;
        }
    .nav-medium {
        padding: 10px 0;
        background-color: #00203c!important;
    }
    .nav-medium svg {
        fill:white;
    }

    .uk-navbar-nav>li>a, .nav-bg a, .toggle a{
            color: white;
    }
    .nav-bg a:hover , .toggle a:hover{
        color: #6f8ea9;
        text-decoration: none;
    }
</style>
