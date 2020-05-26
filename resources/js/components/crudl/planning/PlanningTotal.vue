<template>
    <div>
    <b-row>
        <b-colxx xl="12" lg="12" md="12" class="mb-4">
            <table class="table table-hover table-borderless">
                <thead>
                <tr>
                    <th>Date</th>
                    <th v-for="(data, index) in planningTotal.sorts">{{data}}</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(data, index) in planningTotal.planningTotal">
                    <th slot-scope="row">{{index.replace(/_/g, `-`).slice(0, 10)}}</th>
                    <td v-for="(dataa) in data">{{dataa}}</td>
<!--                    <td>{{planningTotal.total['total']}}</td>-->
                </tr>
                </tbody>
            </table>
        </b-colxx>
    </b-row>
</div>
</template>

<script>

    // TODO
    // change disabled style for today -3 days for darkmode. this does not work properly yet!

    // import vSelect from "vue-select";
    import Vuetable from "vuetable-2/src/components/Vuetable";
    import {mapGetters} from "vuex";

    export default {
        name: "PlanningCreate",
        components: {
        },
        data() {
            return {
                data: []
            }
        },
        computed: {
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers'
            }),
            planningTotal() {
                return this.$store.getters.planningTotal;
            },
        },
        methods: {
            getPlanningTotal() {
                this.$store.dispatch("getPlanningTotal");
            },
        },
        mounted() {
            Promise.all([
                this.getPlanningTotal(),
                // this.$moment().subtract(4, 'days').format('YYYY-MM-DD'), this.$moment().add(7, 'days').format('YYYY-MM-DD')
            ]).finally(() => {
                //finally
            })
        },
    }
</script>

<style scoped>
    .loading {
        display: inline-block !important;
        width: 30px !important;
        height: 30px !important;
        border-radius: 50% !important;
        animation: spin 1s ease-in-out infinite !important;
        -webkit-animation: spin 1s ease-in-out infinite !important;
        position: absolute !important;
        z-index: 1 !important;
    }
</style>
