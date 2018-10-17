<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    export default {
        template: require('./resetpassword.html'),
        data() {
            return {
                requestId: this.$route.query.request_id,
                password: '',
                password_confirmation: '',
                error: {
                    requestId: '',
                    password: '',
                }
            }
        },
        methods: {
            updatePassword() {
                var payload = {
                    request_id: this.requestId,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                };
                // alert('sent request');
                this.$store.dispatch('updatePassword', payload).then(
                    response => {
                        if (!!response.data.message && response.data.message === "change password completed") {
                            alert("password updated");
                            console.log(response);
                            this.$router.push("/");
                        } else {
                            console.log(response);
                            this.error = response.data;
                        }
                    }
                );
            }
        },
        created() {
            // alert(this.$route.query.request_id)
        }
    }
</script>

<style lang="scss">
    // @import './resetpassword.scss';
</style>
