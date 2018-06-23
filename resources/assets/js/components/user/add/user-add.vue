<script>
    import axios from 'axios';
    import Datepicker from 'vuejs-datepicker';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    export default {

        template: require('./user-add.html'),

        components: {
            Datepicker
        },

        data() {
            return {
                user: {
                    role: '',
                    gender: '',
                    name_title: '',
                    date_of_birth: '',
                },
                date: '',
                form: {}
            };
        },

        computed: {},

        created() {
            axios.get("/user/form")
                .then(response => {
                        // console.log(response)
                        this.form = response.data.form;
                        console.log(response);
                    }
                ).catch(error => {
                    console.log(error);
                }
            );
        },

        methods: {
            dob() {
                let mydate = new Date(this.date);
                let day = mydate.getDate();
                let month = mydate.getMonth(); // month (in integer 0-11)
                let year = mydate.getFullYear(); // year
                this.user.date_of_birth = year + "/" + (month + 1) + "/" + day;
                return this.user.date_of_birth;
            },
            addUser() {
                var payload = this.user;
                console.log(payload);
                this.$store.dispatch('addUser', payload)
                    .then(response => {
                            console.log(response)
                            // this.$router.push("/")
                        }, error => {
                            console.log(error)
                            // this.errors.push(error)
                        }
                    );
            }
        }

    }
</script>

<style lang="scss">
    // @import './register.scss';
</style>
