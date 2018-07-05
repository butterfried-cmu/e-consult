<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    import {store} from "../../../vuex/store";

    export default {
        template: require('./user-view.html'),
        data(){
            return {

            }
        },
        computed: {
            user(){
                return this.$store.getters['currentUser'];
            },
            role(){
                return this.$store.getters['userRole']
            },
            image_src(){
                return "../../images/users/" + this.$store.getters['currentUser'].image_name;
            }
        },
        methods: {
        }
    }
</script>

<style lang="scss">
    // @import './profile.scss';
</style>
