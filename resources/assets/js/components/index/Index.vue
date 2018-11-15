<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';

    export default {
        template: require('./index.html'),
        mounted() {
            this.loadConsultList();
        },
        computed: {
            user() {
                return this.$store.getters['currentUser'];
            },
            consultDraft() {
                return this.$store.getters['consultDraftList'];
            },
            consultPending() {
                return this.$store.getters['consultPendingList'];
            },
            consultDone() {
                return this.$store.getters['consultDoneList'];
            }
        },
        methods: {
            isRole(role) {
                for (var i = 0; i < this.$store.getters['userRole'].length; i++) {
                    if (role == this.$store.getters['userRole'][i]) return true;
                }
                return false;
                // return role === this.$store.getters['userRole'];
            },
            deleteConsult(consult_id) {
                var payload = consult_id;
                var r = confirm('Are you sure?');
                if (r == true) {
                    this.$store.dispatch('getDeleteConsult', payload).then(
                        response => {
                            console.log('Consult deleted successfully')
                            this.loadConsultList();
                        },
                        error => {
                            console.log('Delete consult error')
                        }
                    );
                } else {
                }
            },

            viewConsult(consult_id) {
                console.log('select ' + consult_id);
                this.$router.push('/consults/' + consult_id);
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

            messageConsult(consult_id) {
                console.log('message ' + consult_id);
                this.$router.push('/consults/' + consult_id + '/message');
            },

            replyConsult(consult_id) {
                console.log('reply ' + consult_id);
                this.$router.push('/consults/' + consult_id + '/reply');
            },

            loadConsultList() {
                this.$store.dispatch('getAllConsults').then(
                    response => {
                        console.log('Consult lists GET');
                    }
                )
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
        }
    }

</script>

<style scoped>
    #index {
        margin-left: 3%;
        margin-right: 3%;
    }

    th {
        font-size: inherit;
    }

    .title {
        font-size: large;
    }

    .badge-bg-success {
        background-color: #5cb85c;
    }

    .badge-bg-warning {
        background-color: #ffae42;
    }
</style>

