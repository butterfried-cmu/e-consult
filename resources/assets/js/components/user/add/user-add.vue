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
                    username: null,
                    password: null,
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

        created() {
            // this.loadFormdata();
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
                let payload = this.user;
                if (payload.date_of_birth == 'NaN/NaN/NaN'){
                    console.log('checked');
                    payload.date_of_birth = '';
                }
                console.log(payload);
                this.$store.dispatch('addUser', payload)
                    .then(response => {
                            if (!!response.data.message && response.data.message === "Successfully created user") {
                                alert("Create success");
                                console.log(response);
                                this.$router.push("/");
                            }else{
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
                    vm.user.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            uploadImage() {
                axios.post('/image/store', {image: this.image}).then(response => {
                    console.log(response);
                });
            },
        }

    }
</script>

<style lang="scss">
    // @import './register.scss';
</style>
