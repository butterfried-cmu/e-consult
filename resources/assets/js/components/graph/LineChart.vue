<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
    data () {
    return {
      gradient: null,
      gradient2: null
    }
  },
  mounted () {
    // Graph Color
    this.gradient = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
    this.gradient.addColorStop(0, 'rgba(255, 0,0, 0.5)')
    this.gradient.addColorStop(0.5, 'rgba(255, 0, 0, 0.25)');
    this.gradient.addColorStop(1, 'rgba(255, 0, 0, 0)');

    this.gradient2 = this.$refs.canvas.getContext('2d').createLinearGradient(0, 0, 0, 450)
    this.gradient2.addColorStop(0, 'rgba(0, 231, 255, 0.9)')
    this.gradient2.addColorStop(0.5, 'rgba(0, 231, 255, 0.25)');
    this.gradient2.addColorStop(1, 'rgba(0, 231, 255, 0)');

    // Overwriting base render method with actual data.
    this.renderChart({
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: 'Alzheimer’s disease',
          borderColor: '#FC2525',
          pointBackgroundColor: 'white',
          borderWidth: 1,
          pointBorderColor: '#FC2525',
          backgroundColor: this.gradient,
          data: [40, 20, 12, 39, 10, 40, 39, 80, 40, 20, 12, 11]
        },
        {
          label: 'Bipolar disorder',
          borderColor: '#05CBE1',
          pointBackgroundColor: 'white',
          pointBorderColor: '#05CBE1',
          borderWidth: 1,
          backgroundColor: this.gradient2,
          data: [10, 3, 22, 30, 5, 20, 29, 50, 60, 40, 10, 10]
        }
      ]
    }, {responsive: true, maintainAspectRatio: false}
    )
  }
}
</script>

