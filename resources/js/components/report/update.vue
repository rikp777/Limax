<template>
    <form class="needs-validation" @submit.prevent="validateBeforeSubmit">
        <div class="row">
            <div class="col">
                <div class="form-row">
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
                            <td>5</td>
                            <td>58,9 KG</td>
                            <td>294,5 ‬KG</td>
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
            report(){
                return this.$store.getters.report;
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
