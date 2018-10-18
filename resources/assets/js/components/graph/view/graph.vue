<script>
    import LineChart from './LineChart.vue';
    import axios from 'axios';

    export default {
        template: require('./graph.html'),
        name: 'graph',
        components: {
            LineChart
        },
        data() {
            return {
                datacollection: null,
                start_date: null,
                end_date: null,
            }
        },
        mounted() {
            console.log('mounted');
            this.getAllSummary();
        },
        methods: {
            fillData(data) {
                console.log('FILL DATA');

                var self = this;
                var labels = [];
                var data_set = [];
                var backgroundColors = [];

                data.forEach(function(item) {
                    labels.push(item.disease_name);
                    data_set.push(item.amount);
                    backgroundColors.push(self.randomColor());
                });

                this.datacollection = {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Bipolar disorder',
                            borderColor: '#ffffff',
                            pointBackgroundColor: 'white',
                            pointBorderColor: '#05CBE1',
                            borderWidth: 3,
                            data: data_set,
                            backgroundColor: backgroundColors,
                        }
                    ]
                }
            },

            getAllSummary() {
                setTimeout(() => {
                    axios.get("/consults/summary/?token=" + localStorage.getItem('token'))
                        .then(
                            response => {
                                console.log(response);
                                this.fillData(response.data);
                            }
                        ).catch(
                        error => {
                            console.log(error);
                        }
                    );
                }, 1000);
            },

            getSummary() {
                setTimeout(() => {
                    axios.post("/consults/summary/?token=" + localStorage.getItem('token'),{
                        start_date: this.start_date,
                        end_date: this.end_date
                    })
                        .then(
                            response => {
                                console.log(response);
                                this.fillData(response.data);
                            }
                        ).catch(
                        error => {
                            console.log(error);
                        }
                    );
                }, 1000);
            },

            randomColor() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgb(" + r + "," + g + "," + b + ")";
            }
        },
    }
</script>
<style scoped>
    h1 {
        margin-top: -3px;
        font-size: 3em;
    }

    h5 {
        margin-top: -10px;
    }

    .span-font-style {
        font-size: 1.5em;
    }

    #wrap {
        margin-top: 100px;
    }
</style>

