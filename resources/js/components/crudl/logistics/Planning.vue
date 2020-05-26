<!--<template>-->

<!--    <div class="container-fluid">-->

<!--        <b-button class="ml-2" variant="light" size="sm" toggle-class="language-button"-->
<!--                  v-for="(farmer,index) in authUserFarmers" :key="index"-->
<!--                  @click="changeFarmer(farmer)">{{farmer.name}}-->
<!--        </b-button>-->
<!--        <b-dropdown id="farmer" class="ml-2" variant="light" size="sm" toggle-class="language-button">-->
<!--            <template slot="button-content">-->
<!--                &lt;!&ndash;                        <span class="name">{{authFarmer.name}}</span>&ndash;&gt;-->
<!--                <span class="name">More Farmers</span>-->
<!--            </template>-->
<!--            <b-dropdown-item v-for="(farmer,index) in authUserFarmers" :key="index"-->
<!--                             @click="changeFarmer(farmer)">{{farmer.name}}-->
<!--            </b-dropdown-item>-->
<!--        </b-dropdown>-->
<!--        &lt;!&ndash;        {{planningIsLoading}}&ndash;&gt;-->
<!--        &lt;!&ndash;        {{planningTotalFarmer.length}}&ndash;&gt;-->
<!--        <div v-if="planningTotalFarmer.length !== 0">-->
<!--            <div v-if="!planningIsLoading">-->
<!--                <hr>-->
<!--                <div class="row">-->
<!--                    <b-colxx xxs="12">-->
<!--                        <b-card class="mb-4">-->
<!--                            <b-card-header><h4 style="display: inline">{{authFarmer.name}}</h4> <span-->
<!--                                style="display: inline">(last loaded: </span><span style="display: inline"-->
<!--                                                                                   v-for="(data, index) in planningTotalFarmer.lastupdate">{{data}}</span><span>)</span>-->
<!--                            </b-card-header>-->
<!--                            <b-card-body>-->
<!--                                <table class="table table-hover table-borderless">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th>Date</th>-->
<!--                                        <th v-for="(data, index) in planningTotalFarmer.sortsFarmer">{{data}}</th>-->
<!--                                        <th>Total</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    <tr v-for="(data, index) in planningTotalFarmer.planningTotalFarmer">-->
<!--                                        <th scope="row">{{index.replace(/_/g, `-`).slice(0, 10)}}</th>-->
<!--                                        <td v-for="(dataa) in data">{{dataa}}</td>-->
<!--                                        &lt;!&ndash;                    <td>{{planningTotal.total['total']}}</td>&ndash;&gt;-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
<!--                            </b-card-body>-->
<!--                        </b-card>-->
<!--                    </b-colxx>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div v-else>-->
<!--            <b-jumbotron header="Planning" lead="">-->
<!--                &lt;!&ndash;                            <p>Select a farmer</p>&ndash;&gt;-->
<!--                &lt;!&ndash;                            <b-button variant="primary" :href='$route.path + "/docs"'>Documentation</b-button>&ndash;&gt;-->
<!--            </b-jumbotron>-->
<!--        </div>-->
<!--    </div>-->

<!--    &lt;!&ndash;    <b-row>&ndash;&gt;-->
<!--    &lt;!&ndash;        <b-colxx xl="12" lg="12" md="12" class="mb-4">&ndash;&gt;-->
<!--    &lt;!&ndash;            <table class="table table-hover table-borderless">&ndash;&gt;-->
<!--    &lt;!&ndash;                <thead>&ndash;&gt;-->
<!--    &lt;!&ndash;                <tr>&ndash;&gt;-->
<!--    &lt;!&ndash;                    <th>Date</th>&ndash;&gt;-->
<!--    &lt;!&ndash;                    <th v-for="(data, index) in planningTotal.sorts">{{data}}</th>&ndash;&gt;-->
<!--    &lt;!&ndash;                    <th>Total</th>&ndash;&gt;-->
<!--    &lt;!&ndash;                </tr>&ndash;&gt;-->
<!--    &lt;!&ndash;                </thead>&ndash;&gt;-->
<!--    &lt;!&ndash;                <tbody>&ndash;&gt;-->
<!--    &lt;!&ndash;                <tr v-for="(data, index) in planningTotal.planningTotal">&ndash;&gt;-->
<!--    &lt;!&ndash;                    <th scope="row">{{index.replace(/_/g, `-`).slice(0, 10)}}</th>&ndash;&gt;-->
<!--    &lt;!&ndash;                    <td v-for="(dataa) in data">{{dataa}}</td>&ndash;&gt;-->
<!--    &lt;!&ndash;&lt;!&ndash;                    <td>{{planningTotal.total['total']}}</td>&ndash;&gt;&ndash;&gt;-->
<!--    &lt;!&ndash;                </tr>&ndash;&gt;-->
<!--    &lt;!&ndash;                </tbody>&ndash;&gt;-->
<!--    &lt;!&ndash;            </table>&ndash;&gt;-->
<!--    &lt;!&ndash;        </b-colxx>&ndash;&gt;-->
<!--    &lt;!&ndash;    </b-row>&ndash;&gt;-->
<!--</template>-->

<!--<script>-->

<!--    // TODO-->
<!--    // change disabled style for today -3 days for darkmode. this does not work properly yet!-->

<!--    import vSelect from "vue-select";-->
<!--    import Vuetable from "vuetable-2/src/components/Vuetable";-->
<!--    import {-->
<!--        mapActions,-->
<!--        mapGetters, mapMutations-->
<!--    } from 'vuex';-->

<!--    export default {-->
<!--        name: "PlanningCreate",-->
<!--        components: {},-->
<!--        data() {-->
<!--            return {-->
<!--                data: [],-->
<!--            }-->
<!--        },-->
<!--        computed: {-->
<!--            ...mapGetters({-->
<!--                authFarmer: 'authFarmer',-->
<!--                authUserFarmers: 'authUserFarmers',-->
<!--                planningIsLoading: 'planningIsLoading'-->
<!--            }),-->
<!--            // plannings() {-->
<!--            //     return this.$store.getters.plannings;-->
<!--            // },-->
<!--            // planning() {-->
<!--            //     return this.$store.getters.planning;-->
<!--            // },-->
<!--            planningTotalFarmer() {-->
<!--                return this.$store.getters.planningTotalFarmer;-->
<!--            },-->
<!--        },-->
<!--        methods: {-->
<!--            ...mapMutations(['changeAuthFarmer']),-->
<!--            ...mapActions(['setFarmer']),-->
<!--            changeFarmer(farmer) {-->
<!--                this.setFarmer(farmer.uid);-->
<!--                this.changeAuthFarmer(farmer);-->
<!--                // this.getLogistic(farmer.id)-->

<!--                this.$store.dispatch("getPlanningTotalFarmer", farmer.id).then(() => {-->
<!--                    // this.data = this.logistic.totalArticles;-->
<!--                    // this.dataPalletlabel = this.logistic.totalLabels;-->
<!--                    // this.getPlanningTotalFarmer();-->
<!--                })-->

<!--            },-->
<!--            // getPlanningTotalFarmer() {-->
<!--            //     this.$store.dispatch("getPlanningTotalFarmer");-->
<!--            // },-->
<!--        },-->
<!--        mounted() {-->
<!--            // Promise.all([-->
<!--            //     // this.getPlanningTotal(),-->
<!--            //     // this.$moment().subtract(4, 'days').format('YYYY-MM-DD'), this.$moment().add(7, 'days').format('YYYY-MM-DD')-->
<!--            // ]).finally(() => {-->
<!--            //     //finally-->
<!--            // })-->
<!--        },-->
<!--    }-->
<!--</script>-->

<!--<style scoped>-->
<!--    .loading {-->
<!--        display: inline-block !important;-->
<!--        width: 30px !important;-->
<!--        height: 30px !important;-->
<!--        border-radius: 50% !important;-->
<!--        animation: spin 1s ease-in-out infinite !important;-->
<!--        -webkit-animation: spin 1s ease-in-out infinite !important;-->
<!--        position: absolute !important;-->
<!--        z-index: 1 !important;-->
<!--    }-->
<!--</style>-->
