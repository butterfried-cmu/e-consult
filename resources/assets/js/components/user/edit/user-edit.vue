<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';
    import Datepicker from 'vuejs-datepicker';

    export default {
        template: require('./user-edit.html'),
        components: {
            Datepicker
        },

        data() {
            return {
                edited_user: {
                    role: '',
                    gender: '',
                    name_title: '',
                    image: '',
                },
                date: '',
                form: {
                    roles: [
                        {role: "ADMIN"},
                        {role: "DOCTOR"},
                        {role: "NURSE"},
                    ],
                    name_titles: [
                        {title: "Mr."},
                        {title: "Mrs."},
                        {title: "Miss"},
                        {title: "Professor"},
                        {title: "Assistant Professor"},
                        {title: "Associate "},
                    ],
                    genders: [
                        {gender: "Male"},
                        {gender: "Female"},
                    ]
                },
                error: {
                    role: null,
                    email: null,
                    name_title: null,
                    first_name: null,
                    last_name: null,
                    gender: null,
                    citizen_id: null,
                    date_of_birth: null,
                    contact_number: null,
                    address: null,
                    workplace: null,
                    image: null,
                },
            };
        },

        computed: {},

        mounted() {
            this.edited_user = JSON.parse(JSON.stringify(this.$store.getters['currentUser']));
            this.edited_user.role = this.$store.getters['userRole'];
            this.date = this.edited_user.date_of_birth;
        },

        methods: {
            dob() {
                let mydate = new Date(this.date);
                let day = mydate.getDate();
                let month = mydate.getMonth(); // month (in integer 0-11)
                let year = mydate.getFullYear(); // year
                this.edited_user.date_of_birth = year + "/" + (month + 1) + "/" + day;
                return this.edited_user.date_of_birth;
            },
            updateUser() {
                let payload = this.edited_user;
                if (payload.date_of_birth == 'NaN/NaN/NaN') {
                    console.log('checked');
                    payload.date_of_birth = '';
                }
                console.log(payload);
                this.$store.dispatch('updateUser', payload)
                    .then(response => {
                            if (!!response.data.message && response.data.message === "successfully updated user") {
                                alert("The information has been updated.");
                                console.log(response);
                                this.$router.push("/");
                            } else {
                                this.error = response.data;
                            }
                        }
                    );
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.edited_user.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            isRole(role) {
                for (var i = 0; i < this.$store.getters['userRole'].length; i++) {
                    if (role == this.$store.getters['userRole'][i]) return true;
                }
                return false;
                // return role === this.$store.getters['userRole'];
            },
        }
    }
</script>

<style lang="scss">
    // @import './editprofile.scss';
</style>
