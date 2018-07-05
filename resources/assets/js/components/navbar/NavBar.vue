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
                return role === this.$store.getters['userRole'];
            }
        }
    }
</script>

<style lang="scss">
    // @import './navbar.scss';
</style>
