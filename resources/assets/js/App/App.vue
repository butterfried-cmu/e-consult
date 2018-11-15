<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';

    import NavBar from '../components/navbar/NavBar.vue';

    export default {

        template: require('./App.html'),
        data() {
            return {
                msg: 'Hello'
            }
        },
        created() {
            this.$store.dispatch('init');
            this.$store.dispatch('onRefresh');
        },
        components: {
            NavBar
        }
    }
</script>

<style>
@media (min-width:769px) {
    #consult-add,#graph,#consult-view,#message,#register,#user-list,#edit,#profile,#reply {
        margin-top: 80px;
    }
    .sticky {
        top: 120px!important;
        position: sticky;
    }
}
</style>
