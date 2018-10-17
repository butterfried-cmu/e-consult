<script>
    export default {
        template: require('./consult-view.html'),
        data() {
            return {}
        },
        mounted() {
            let payload = this.$route.params.consult_id;
            console.log(payload)
            this.$store.dispatch('getConsult', payload).then(
                response => {
                    // this.isLoading = true;
                }
            );
        },
        computed: {
            currentConsult() {
                return this.$store.getters['currentConsult'];
            }
        },
        methods: {
            isDraft(){
                if ( this.currentConsult.status == 'draft' ) return true;
                return false;
            },
            isPending(){
                if ( this.currentConsult.status == 'pending' ) return true;
                return false;
            },
            isDone(){
                if ( this.currentConsult.status == 'done' ) return true;
                return false;
            },
            editConsult(consult_id) {
                console.log('edit ' + consult_id);
                this.$router.push('/consults/' + consult_id + '/edit');
            },
            sendConsult(consult_id) {
                var payload = consult_id;
                var r = confirm('Are you sure?');
                if (r == true) {
                    this.$store.dispatch('getSendConsult', payload).then(
                        response => {
                            alert('Consult sent successfully');
                            // this.loadConsultList();
                        },
                        error => {
                            console.log('Delete consult error')
                        }
                    );
                } else {
                }
            },
            printConsult(consult_id) {
                var payload = consult_id;
                this.$store.dispatch('getPrintConsult', payload).then(
                    response => {
                        console.log(response);
                        // this.loadConsultList();
                        window.open(response.data.file_link, '_blank');
                    },
                    error => {
                        console.log('Unable to print')
                    }
                );
            },
            messageConsult(consult_id) {
                console.log('message ' + consult_id);
                this.$router.push('/consults/' + consult_id + '/message');
            },
        }
    }
</script>
<style scoped>

</style>

