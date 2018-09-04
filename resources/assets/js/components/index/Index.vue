<script>
    // import axios from 'axios';
    // import {APIENDPOINT} from  '../../http-common.js';
	// import loginService from './adminService.js';

    export default {
		template: require('./index.html'),
        data(){
            return {
                user: {},
            }
        },
        computed: {
            user() {
                return this.$store.getters['currentUser'];
            }
        },
		methods: {
			isRole(role) {
                for (var i = 0; i < this.$store.getters['userRole'].length; i++) {
                    if (role == this.$store.getters['userRole'][i]) return true;
                }
                return false;
                // return role === this.$store.getters['userRole'];
            }
		}
	}
	
</script>

<style scoped>
#index {
	margin-left: 3%;
	margin-right: 3%;
}
</style>

