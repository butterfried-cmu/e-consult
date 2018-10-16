<script>
    import axios from 'axios';
    import Datepicker from 'vuejs-datepicker';
    
export default {
   template: require('./consult-add.html'),
   
   data(){
       return {
           form: {
                },
           consult:{}
       }
   },

    computed: {
        user_id(){
            return this.$store.getters['currentUser'].user_id;
        }
    },

    methods: {
        saveConsult() {
            let payload = this.consult;
            if (payload.dob == 'NaN/NaN/NaN'){
                console.log('checked');
                payload.dob = '';
            }
            if (payload.rec01_date == 'NaN/NaN/NaN'){
                console.log('checked');
                payload.date_of_birth = '';
            }
            if (payload.rec02_date == 'NaN/NaN/NaN'){
                console.log('checked');
                payload.date_of_birth = '';
            }
            payload.user_id = this.$store.getters['currentUser'].user_id;
            console.log(payload);
            this.$store.dispatch('saveConsult', payload)
                .then(response => {
                        if (!!response.data.message && response.data.message === "success") {
                            alert("Succeeded");
                            console.log('consult saved as draft');
                            this.$router.push("/");
                        }else{
                            this.error = response.data;
                        }
                    }
                );
        },
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

.sticky {
  position: -webkit-sticky; /* Safari */
  position: sticky;
  top: 0;
}
</style>

