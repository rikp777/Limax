<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item" v-for="farmer in farmers">
                                    <button type="button" class="btn btn-primary btn-lg nav-link"
                                            @click="constructListOfIntervals(moment().subtract(4, 'days').format('YYYY-MM-DD'), moment().add(7, 'days').format('YYYY-MM-DD'), 'day')">
                                        {{farmer.name}}
                                    </button>
<!--                                    <button type="button" class="btn btn-primary btn-lg nav-link"-->
<!--                                            @click="loadFarmerPlanning(farmer.id, moment().format('YYYY-MM-DD'), moment().endOf('isoweek').format('YYYY-MM-DD'))">-->
<!--                                        {{farmer.name}}-->
<!--                                    </button>-->
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col" v-for="">First</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            </tbody>
                        </table>

                        <ul>
                            <li v-for="interval in intervals">
                                {{ interval }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: "planningCreate",
        data() {
            return {
                serverErrors: '',
                intervals: {}
            }
        },
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"]),
            farmers() {
                return this.$store.getters.farmers;
            },
            planning() {
                return this.$store.getters.planning;
            },
        },
        mounted() {
            this.getAllPlannings();
            this.getAllFarmers();
        },
        methods: {
            getAllFarmers() {
                this.$store.dispatch("getAllFarmers");
            },
            getAllPlannings() {
                this.$store.dispatch("getAllPlannings");
            },
            getFarmerById(id) {
                return this.$store.getters.farmerById(id);
            },
            loadFarmerPlanning(id) {

            },
            constructListOfIntervals(start, end, interval) {
                //object
                const intervals = {};
                const diffUnitOfTime = `${interval}s`;

                while (moment(end).diff(start, diffUnitOfTime) > 0) {
                    const currentEnd = moment(moment(start).add(1, diffUnitOfTime)).format('YYYY-MM-DD');

                    Object.assign(intervals, {[start]: currentEnd});

                    start = currentEnd;
                }
                this.intervals = intervals;
                //console.log(intervals);
            }
        }
    }
</script>

<style scoped>

</style>
