<script>
    import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';

    export default {
        template: require('./user-list.html'),
        data() {
            return {
                paginate: ['users'],
                shown: false,
                keyword: '',
            }
        },
        mounted () {
            this.$store.dispatch('getAllUsers').then(
                response => {
                }
            );
        },
        methods: {
            selectUser(id) {
                console.log('select ' + id);
                this.$router.push('/users/'+id);
            },
            editUser(id) {
                console.log('edit ' + id);
                this.$router.push('/profile/edit/'+id);
            },
            deleteUser(id) {
                var payload = id;
                var r = confirm('Are you sure?');
                if (r == true) {
                    this.$store.dispatch('getDelete',payload).then(
                        response => {
                            this.$store.dispatch('getAllUsers').then(
                                response => {
                                }
                            );
                        }
                    );
                } else {
                }
            },
            search(){
                var payload = this.keyword;
                this.$store.dispatch('getSearch',payload).then(
                    response => {}
                );
            }
        },
        computed: {
            users(){
                return this.$store.getters['allUsers'];
            }
        }
    }
</script>
