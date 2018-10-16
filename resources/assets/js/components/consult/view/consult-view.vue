<script>
export default {
    template: require('./consult-view.html'),
    data(){
        return {
        }
    },
    mounted () {
        let payload = this.$route.params.consult_id;
        console.log(payload)
        this.$store.dispatch('getConsult',payload).then(
            response => {
                // this.isLoading = true;
            }
        );
    },
    computed: {
        currentConsult(){
            return this.$store.getters['currentConsult'];
        }
    },
    methods: {
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
                        console.log('Consult sent successfully');
                        this.loadConsultList();
                    },
                    error => {
                        console.log('Delete consult error')
                    }
                );
            } else {
            }
        },
    }
}
</script>
<style scoped>

</style>

