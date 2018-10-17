<script>
import LineChart from './LineChart.vue'

export default {
    template: require('./graph.html'),
    name:'graph',
    components: {
        LineChart
    }
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

