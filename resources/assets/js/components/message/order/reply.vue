<script>
    export default {
        template: require('./reply.html'),
        data() {
            return {
                currentConsult: {},
                consult_order: '',
            }
        },
        mounted() {
            let payload = this.$route.params.consult_id;
            console.log(payload);
            this.$store.dispatch('getConsult', payload).then(
                response => {
                }
            );
        },
        methods: {
            replyConsult() {
                ///consults/{consult_id}/reply
                this.$store.dispatch('postReplyConsult', this.consult_order)
                    .then(response => {
                            if (!!response.data.message && response.data.message === "success") {
                                alert("Succeeded");
                                console.log('consult edited');
                                this.$router.push("/");
                            } else {
                                this.error = response.data;
                            }
                        }
                    )
            }
        },
        computed: {
            currentConsult() {
                return this.$store.getters['currentConsult'];
            }
        }
    }
</script>

<style scoped>
    .scrollbox {
        height: 80vh;
        overflow: auto;
    }

    .vertical-divider {
        border-left: 2px solid #F8F8F8;
        max-height: 100%;
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>

