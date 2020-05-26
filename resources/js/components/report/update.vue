<template>
    <form class="needs-validation" @submit.prevent="validateBeforeSubmit">
        <div class="row">
            <div class="col">
                <div class="form-row">
<!--                    {{reports}}-->
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Total Pallets</th>
                            <th scope="col">AVG Weight per Pallet</th>
                            <th scope="col">Total Weight</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{reports.totalpallets}}</td>
                            <td>{{reports.avgpalletweight}} KG</td>
                            <td>{{reports.totalpalletweight}} KG</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="form-row">
                    <div class="col mb-3">
                        <ChartDoughnut />
                    </div>
                </div>
                <div class="form-row">
<!--                    {{reports.labels}}-->
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Crop Date</th>
                            <th scope="col">Article Amount</th>
                            <th scope="col">Sort</th>
                            <th scope="col">Weight</th>
                            <th scope="col">Note</th>
                            <th scope="col">Status</th>
                            <th scope="col">Cell</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="report in reports.labels">
                            <td>{{report.id}}</td>
                            <td>{{report.cropDate}}</td>
                            <td>{{report.articleAmount}}</td>
                            <td>{{report.sort}}</td>
                            <td>{{report.weight}} KG</td>
                            <td>{{report.note}}</td>
                            <td>{{report.statusDescription}}</td>
                            <td>{{report.cellNumber + '. ' + report.cellDescription}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import {mapGetters} from 'vuex';
    import {getToken} from '../../common/jwt.service';
    import ChartDoughnut from "./weightDoughnut";

    export default {
        components: {
            ChartDoughnut
        },
        name: "profile-update",
        data() {
            return {
                form: {
                    cells: [],
                },
                delMode: false,
                btnShow: '',
                isChecked: '',
                serverErrors: '',
                updateMode: false,
            }
        },
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"]),
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
                        // console.log(this.reports);
                        // this.form.cells = this.cells;
                    });
            },
        }
    }
</script>

<style scoped>

</style>
