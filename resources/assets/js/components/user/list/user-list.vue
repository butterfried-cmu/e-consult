<script>
    import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';

    export default {
        template: require('./user-list.html'),
        data() {
            return {
                isLoading: false,
                paginate: ['users'],
                shown: false
            }
        },
        mounted () {
            this.$store.dispatch('getAllUsers').then(
                response => {
                    this.isLoading = true;
                }
            );
        },
        methods: {
            selectUser(id) {
                console.log('select ' + id);
                // this.$router.push('/user/'+id);
            },
            deleteUser(id) {
                console.log('delete ' + id);
            }
        },
        computed: {
            users(){
                return this.$store.getters['allUsers'];
            },
            isLoading(){
                return this.isLoading;
            }
        }
    }
</script>
