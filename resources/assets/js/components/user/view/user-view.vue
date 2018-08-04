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
        mounted () {
            let payload = this.$route.params.id;
            this.$store.dispatch('getUser',payload).then(
                response => {
                    this.isLoading = true;
                }
            );
        },
        computed: {
            currentViewUser(){
                return this.$store.getters['currentViewUser'];
            }
        },
        methods: {
        }
    }
</script>

<style lang="scss">
    // @import './profile.scss';
</style>
