<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    import {store} from "../../../vuex/store";

    export default {
        template: require('./user-view.html'),
        computed: {
            user(){
                return this.$store.getters['currentUser'];
            }
        },
        methods: {
        }
    }
</script>

<style lang="scss">
    // @import './profile.scss';
</style>
