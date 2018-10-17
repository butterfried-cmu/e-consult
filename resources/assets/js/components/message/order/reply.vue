<script>
    export default {
        template: require('./reply.html'),
        data() {
            return {
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
                let payload = {
                    consult_id: this.currentConsult.consult_id,
                    consult_order: this.consult_order,
                };
                this.$store.dispatch('postReplyConsult', payload)
                    .then(response => {
                            if (!!response.data.message && response.data.message === "success") {
                                console.log('reply Succeeded');
                                alert('reply Succeeded');
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

