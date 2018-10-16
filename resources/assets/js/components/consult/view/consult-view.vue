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
    }
}
</script>
<style scoped>

</style>

