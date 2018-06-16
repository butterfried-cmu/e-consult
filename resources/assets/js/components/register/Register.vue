<script>
// import axios from 'axios';
// import {APIENDPOINT} from  '../../http-common.js';
// import loginService from './adminService.js';
export default {

  template:require('./register.html'),

  data(){
    return {
      name: '',
      email: '',
      password: '',
      error: false,
      errors: {},
      success: false
    };
  },

  methods: {
    register(){
      var app = this
      this.$auth.register({
        params: {
          name: app.name,
          email: app.email,
          password: app.password
        },
        success: function () {
          app.success = true
        },
        error: function (resp) {
          app.error = true;
          app.errors = resp.response.data.errors;
        },
        redirect: null
      });
    }
  }

}
</script>

<style lang="scss">
// @import './register.scss';
</style>
