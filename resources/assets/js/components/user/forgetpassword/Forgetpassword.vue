<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    export default {
        template: require('./forgetpassword.html'),
        data() {
            return {
                email: '',
                error:{
                    email: '',
                }
            }
        },
        methods: {
            sendRequest(){
                var payload = this.email;
                // alert('sent request');
                this.$store.dispatch('sendRequest',payload).then(
                    response => {
                        if (!!response.data.message && response.data.message === "mail sent") {
                            alert("reset password email sent");
                            console.log(response);
                            this.$router.push("/");
                        } else {
                            console.log(response);
                            this.error = response.data;
                        }
                    }
                );
            }
        }
    }
</script>

<style lang="scss">
    // @import './forgetpassword.scss';
</style>
