<script>
    import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    export default {
        template: require('./login.html'),
        data: {
            username: '',
            password: '',
            errors: []
        },
        methods: {
            login() {
                var payload = {'username': this.username, 'password': this.password};
                console.log('LOGIN');
                this.$store.dispatch('login', payload)
                    .then(response => {
                            this.$router.push("/")
                        }, error => {
                            console.log(error);
                            this.errors.push(error)
                        }
                    );
            }
        },
        computed: {}
    }
</script>

<style lang="scss">
    // @import './login.scss';
</style>
