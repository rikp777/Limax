<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
<!--                    {{reports}}-->
                    <div class="card-body">
                    <h5 class="card-title">Report {{ moment().locale('nl').format('L') }}</h5>
                    <settings-update></settings-update>
                </div>
<!--                    <div class="card-body" v-if="!reports.length">-->
<!--                        <div class="alert alert-warning" role="alert">-->
<!--                            <h5>You have no labels created for this date yet! Make labels to see your report.</h5>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
<!--            <div class="col-4">-->
<!--                <div class="card">-->
<!--                    <div class="card-body">-->
<!--                        <h5 class="card-title">Connections</h5>-->
<!--                        <ul v-for="(farmer, index) in farmers">-->
<!--                            <li>{{farmer.name}}</li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>

</template>

<script>
    import SettingsUpdate from "./update";
    import {getToken} from '../../common/jwt.service';

    export default {
        name: "Index",
        components: {SettingsUpdate},
        props: ['farmers'],
        computed: {
            farmer(){
                return this.$store.getters.farmer;
            },
            reports(){
                return this.$store.getters.reports;
            }
        },
        mounted() {
            this.getFarmer(getToken('farmer'));
            this.getAllReports();
        },
        methods: {
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            },
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
