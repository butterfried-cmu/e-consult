<script>
export default {
    template: require('./consult-list.html'),
    data() {
        return {
            keyword: ''
        }
    },
    mounted(){
        this.loadConsultList();
    },
    computed: {
        consultDone() {
            return this.$store.getters['consultDoneList'];
        }
    },
    methods: {
        loadConsultList() {
            this.$store.dispatch('getAllConsults').then(
                response => {
                    console.log('Consult lists GET');
                }
            )
        },
        viewConsult(consult_id) {
            console.log('select ' + consult_id);
            this.$router.push('/consults/' + consult_id);
        },
        messageConsult(consult_id) {
            console.log('message ' + consult_id);
            this.$router.push('/consults/' + consult_id + '/message');
        },
        searchConsults() {
            console.log('search clicked -> keyword = ' + this.keyword)
            var payload = this.keyword;
            this.$store.dispatch('postSearchConsult',payload ).then(
            )
        }
    }
}
</script>
