<template>
    <div class="card">
        <div class="card-img-bottom">
            <h5 class="card-title">Weight per sort in KG</h5>
            <chartjs-doughnut
                :bind="true"
                :datasets="datasets"
                :labels="labels"
                :option="option"
            />
            <hr>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "weightDoughnut",
        data() {
            return {
                datasets: [
                    {
                        data: [],
                        backgroundColor: ["#eb5b5b", "#ebad5b", "#e9eb5b", "#97eb5b", "#5beb95", "#5bebda", "#5b95eb", "#865beb", "#eb5be1"],
                        hoverBackgroundColor: ["#c87e7e", "#c8a87e", "#c7c87e", "#9dc87e", "#7ec89c", "#7ec8bf", "#7e9cc8" ,"#957ec8", "#c87ec3"]
                    }
                ],
                labels: [],
                option: {}
            };
        },
        computed: {
            // ...mapGetters(["authUser", "isAuthenticated"]),
            reports(){
                return this.$store.getters.reports;
            }
        },
        mounted() {
            this.getAllReports();
        },
        methods: {
            getAllReports() {
                this.$store.dispatch("getAllReports")
                    .then(()=>{
                        $.each(this.reports.sortchartarr, function(key, value) {
                            this.datasets[0].data.push(value);
                            this.labels.push(key);
                        }.bind(this));
                    });
            },
        }
    }
</script>

<style scoped>

</style>
