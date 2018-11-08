<script>
    import {Bar , mixins} from 'vue-chartjs';
    import axios from 'axios';

    export default {
        extends: Bar ,
        mixins: [mixins.reactiveProp],
        data() {
            return {
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true,
                        mode: 'single',
                        callbacks: {
                            label: function(tooltipItems, data) {
                                return tooltipItems.yLabel;
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    height: 200
                }
            }
        },
        mounted() {
            // Graph Color
            // this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
            // this.gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)')
            // this.gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
            // this.gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');
            //
            // this.gradient2 = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
            // this.gradient2.addColorStop(0, 'rgba(0, 231, 255, 0.9)')
            // this.gradient2.addColorStop(0.5, 'rgba(0, 231, 255, 0.25)');
            // this.gradient2.addColorStop(1, 'rgba(0, 231, 255, 0)');

            // Overwriting base render method with actual data.
            // this.renderChart({
            //         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            //         datasets: [
            //             {
            //                 label: 'Bipolar disorder',
            //                 borderColor: '#05CBE1',
            //                 pointBackgroundColor: 'white',
            //                 pointBorderColor: '#05CBE1',
            //                 borderWidth: 1,
            //                 backgroundColor: this.gradient2,
            //                 data: [10, 3, 22, 30, 5, 20, 29, 50, 60, 40, 10, 10]
            //             }
            //         ]
            //     }, {responsive: true, maintainAspectRatio: false}
            // );

            this.renderChart(this.chartData, {responsive: true, maintainAspectRatio: false}
            );

        }
    }
</script>

