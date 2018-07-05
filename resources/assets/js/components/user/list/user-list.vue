<script>
    import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';

    export default {
        template: require('./user-list.html'),
        data() {
            return {
                paginate: ['users'],
                shown: false
            }
        },
        mounted () {
            this.$store.dispatch('getAllUsers');

        },
        methods: {
            selectUser(id) {
                this.$router.push('/user/'+id);
            }
        },
        computed: {
            users(){
                return this.$store.getters['allUsers'];
            }
        }
    }
</script>