<script>
    export default {
        template: require('./consult-edit.html'),
        data() {
            return {
                form: {},
                currentConsult: {}
            }
        },

        computed: {
        },

        mounted() {
            let payload = this.$route.params.consult_id;
            console.log(payload)
            this.$store.dispatch('getConsult',payload).then(
                response => {
                    this.currentConsult = JSON.parse(JSON.stringify(this.$store.getters['currentConsult']));
                }
            );
        },

        methods: {
            saveConsult() {
                let payload = this.consult;
                if (payload.dob == 'NaN/NaN/NaN') {
                    console.log('checked');
                    payload.dob = '';
                }
                if (payload.rec01_date == 'NaN/NaN/NaN') {
                    console.log('checked');
                    payload.date_of_birth = '';
                }
                if (payload.rec02_date == 'NaN/NaN/NaN') {
                    console.log('checked');
                    payload.date_of_birth = '';
                }
                console.log(payload);
                this.$store.dispatch('editConsult', payload)
                    .then(response => {
                            if (!!response.data.message && response.data.message === "success") {
                                alert("Succeeded");
                                console.log('consult edited');
                                this.$router.push("/");
                            } else {
                                this.error = response.data;
                            }
                        }
                    );
            },
        }
    }
</script>
