<script>
    import axios from 'axios';
    import Datepicker from 'vuejs-datepicker';
    
export default {
   template: require('./consult-add.html'),
   
   data(){
       return {
           form: {
                    name_titles: [
                        {title: "Mr."},
                        {title: "Mrs."},
                        {title: "Miss"}
                     ]
                }
       }
   }
}
</script>
<style scoped>
#personalinfo,#medicalinfo,#recordinfo,#consultinfo {
    padding: 2%;
}
.unit input::-webkit-input-placeholder {
  /* WebKit browsers */
  text-align: right;
}
.unit input:-moz-placeholder {
  /* Mozilla Firefox 4 to 18 */
  text-align: right;
}
.unit input::-moz-placeholder {
  /* Mozilla Firefox 19+ */
  text-align: right;
}
.unit input:-ms-input-placeholder {
  /* Internet Explorer 10 */
  text-align: right;
}
.unit input::placeholder {
  text-align: right;
}

.divider {
    background-color: #fafafa;
    padding: 1%;
}
</style>

