<script>
// import axios from 'axios';
// import {APIENDPOINT} from  '../../http-common.js';
// import loginService from './adminService.js';
import { mapGetters } from 'vuex';

export default {
  template:require('./navbar.html'),
  computed: mapGetters({
    user: 'currentUser'
  }),
  methods: {
  }
}
</script>

<style lang="scss">
// @import './navbar.scss';
</style>
