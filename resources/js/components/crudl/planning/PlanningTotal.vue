<template>
    <div>
        <b-colxx md="12" class="mb-4" v-if="noSorts === true">
            <b-card title="Error">
                <b-refresh-button/>

                <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                            <span
                                                class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall">
                                                <i class="simple-icon-exclamation"/>
                                            </span>
                    <div class="pl-3 pr-2">
                        <p class="font-weight-medium mb-0 ">Create a sort link on the settings page</p>
                        <p class="text-muted mb-0 text-small">You need to link sorts to make a planning for</p>
                    </div>
                </div>

            </b-card>
        </b-colxx>
        <b-row v-if="noSorts === false">
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
                        <th scope="row">{{index.replace(/_/g, `-`).slice(0, 10)}}</th>
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

    import vSelect from "vue-select";
    import Vuetable from "vuetable-2/src/components/Vuetable";
    import {mapGetters} from "vuex";

    export default {
        name: "PlanningCreate",
        components: {},
        data() {
            return {
                noSorts: false,
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
                this.$store.dispatch("getPlanningTotal").then(()=>{
                   this.noSorts = false
                }),
            ]).finally(() => {
                if (this.planningTotal.length === 0){
                    this.noSorts = true
                }
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
