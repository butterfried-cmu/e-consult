<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
    // import loginService from './adminService.js';

    import NavBar from '../components/navbar/NavBar.vue';

    export default {

        template: require('./App.html'),
        data() {
            return {
                initialized: false
            }
        },
        components: {
            NavBar
        },
        created () {
            this.fetchData().then(() => { this.initialized = true });
        }
    }
</script>

<style lang="css">
</style>
