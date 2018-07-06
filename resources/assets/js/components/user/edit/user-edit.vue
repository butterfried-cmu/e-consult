<script>
// import axios from 'axios';
// import {APIENDPOINT} from  '../../http-common.js';
// import loginService from './adminService.js';
export default {
  template:require('./user-edit.html'),
  data() {
    return {
        user: {
            role: '',
            gender: '',
            name_title: '',
            date_of_birth: '',
            image: '',
        },
    }
  },
  methods: {
      onImageChange(e) {
          let files = e.target.files || e.dataTransfer.files;
          if (!files.length)
              return;
          this.createImage(files[0]);
      },
      createImage(file) {
          let reader = new FileReader();
          let vm = this;
          reader.onload = (e) => {
              vm.user.image = e.target.result;
          };
          reader.readAsDataURL(file);
      },
      uploadImage() {
          axios.post('/image/store', {image: this.image}).then(response => {
              console.log(response);
          });
      },
  }
}
</script>

<style lang="scss">
// @import './editprofile.scss';
</style>
