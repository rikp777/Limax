<script>
    import {ThemeColors} from '../../utils'
    const colors = ThemeColors()
    import Chart from 'chart.js'
    import {generateChart} from 'vue-chartjs'
    import {centerTextPlugin} from '../../utils'

    import {mapGetters} from "vuex";

    // console.log(colors)
    import {doughnutChartOptions} from './config'

    Chart.defaults.doughnutWithShadow = Chart.defaults.doughnut
    Chart.controllers.doughnutWithShadow = Chart.controllers.doughnut.extend({
        draw: function (ease) {
            Chart.controllers.doughnut.prototype.draw.call(this, ease)
            let ctx = this.chart.chart.ctx
            ctx.save()
            ctx.shadowColor = 'rgba(0,0,0,0.15)'
            ctx.shadowBlur = 10
            ctx.shadowOffsetX = 0
            ctx.shadowOffsetY = 10
            ctx.responsive = true
            Chart.controllers.doughnut.prototype.draw.apply(this, arguments)
            ctx.restore()
        }
    })

    const DoughnutShadow = generateChart('doughnut-with-shadow', 'doughnutWithShadow')

    export default {
        extends: DoughnutShadow,
        // props: ['data'],
        data() {
            return {
                data: {
                    labels: [],
                    datasets: [
                        {
                            label: '',
                            borderColor: [colors.themeColor1, colors.themeColor2, colors.themeColor3, colors.themeColor4, colors.themeColor5, colors.themeColor6],
                            backgroundColor: [
                                colors.themeColor1_10,
                                colors.themeColor2_10,
                                colors.themeColor3_10,
                                colors.themeColor4_10,
                                colors.themeColor5_10,
                                colors.themeColor6_10
                            ],
                            borderWidth: 2,
                            data: []
                        }
                    ]
                },
                options: doughnutChartOptions
            }
        },
        computed: {
            // ...mapGetters(["authUser", "isAuthenticated"]),
            reports() {
                return this.$store.getters.reports;
            }
        },
        mounted() {
            Promise.all([
                this.$store.dispatch("getAllReports")
                    .then(() => {
                        $.each(this.reports.sortchartarr, function (key, value) {
                            this.data.datasets[0].data.push(value);
                            this.data.labels.push(key);
                        }.bind(this));
                    })
            ]).finally(() => {
                this.addPlugin(centerTextPlugin)
                this.renderChart(this.data, this.options)
            });

        },
        methods: {
            getAllReports() {
                this.$store.dispatch("getAllReports")
                    .then(() => {
                        $.each(this.reports.sortchartarr, function (key, value) {
                            this.data.datasets[0].data.push(value);
                            this.data.labels.push(key);
                        }.bind(this));
                    });
            },
        }
    }
</script>
