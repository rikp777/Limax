<template>
    <div>
        <div v-if="!logisticIsLoading">
            <div class="row">
                <b-colxx xxs="12">
                    <b-card class="mb-4">
                        <!--                                    <b-card-header><h4 style="display: inline">{{authFarmer.name}} overzicht</h4>-->
                        <!--                                    </b-card-header>-->
                        <!--                        <b-card-header>-->
                        <!--                            <h4 style="display: inline">{{authFarmer.name + ' overzicht'}}</h4> <span style="display: inline">(last loaded: </span><span style="display: inline" v-for="(data, index) in logistic.lastupdate">{{data}}</span><span>)</span>-->
                        <!--                        </b-card-header>-->
                        <b-card-body>
                            <vue-table
                                table-height="360px"
                                ref="palletlabels"
                                :api-mode="false"
                                :fields="PalletlabelObj.fields"
                                :per-page="perPagePalletlabel"
                                :data-manager="PalletlabeldataManager"
                                pagination-path="pagination"
                            >
                            </vue-table>
                        </b-card-body>
                        <!--                        <b-card-footer>-->
                        <!--                            <span style="display: inline">(last loaded: </span><span style="display: inline" v-for="(data, index) in logistic.lastupdate">{{data}}</span><span>)</span>-->
                        <!--                        </b-card-footer>-->
                    </b-card>
                </b-colxx>
            </div>
            <br>
            <div class="row">
                <b-colxx xl="4" lg="4" md="4" class="mb-4">
                    <b-card class="h-100">

                        <b-card-body>
                            <p class="lead color-theme-1 mb-1 value"
                               v-for="(data, key) in logistic.totalLabelsCount">{{data.totalLabels}}
                                X</p>
                            <p class="mb-0 label text-small">Aantal Pallets</p>
                        </b-card-body>
                    </b-card>
                </b-colxx>

                <b-colxx xl="8" lg="8" md="8" class="mb-4">
                    <b-card class="h-100">
                        <b-card-body>
                            <vue-table
                                table-height="360px"
                                ref="artikels"
                                :api-mode="false"
                                :fields="reportsObj.fields"
                                :per-page="perPage"
                                :data-manager="dataManager"
                                pagination-path="pagination"
                            >
                            </vue-table>
                        </b-card-body>
                    </b-card>
                </b-colxx>
            </div>
        </div>
        <div v-else>
            <br>
            <br>
            <br>
            <br>
            <div class="loading"></div>
        </div>
    </div>
</template>

<script>
    // import Sidebar from '../../../containers/menu/logistics/Sidebar'
    // import TopNav from '../../../containers/menu/logistics/TopNav'
    // import Footer from '../../../containers/Footer'
    import {
        mapActions,
        mapGetters, mapMutations
    } from 'vuex'
    // import DarkMode from "../../../components/menu/DarkMode"
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'
    import planningTotal from "../../../components/crudl/planning/PlanningTotal";

    export default {
        components: {
            // DarkMode,
            // 'top-nav': TopNav,
            // 'sidebar': Sidebar,
            // 'footer-component': Footer,
            VueTable,
            VueTablePaginationBootstrap,
            planningTotal
        },
        data() {
            return {
                show: false,
                data: [],
                reportsObj: {
                    fields: [
                        {
                            name: 'article',
                            sortField: 'article',
                            title: 'Artikel',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'articleAmount',
                            sortField: 'articleAmount',
                            title: 'Aantal',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }
                    ]
                },
                perPage: 60,
                dataPalletlabel: [],
                PalletlabelObj: {
                    fields: [
                        {
                            name: 'farmer',
                            sortField: 'farmer',
                            title: 'Bedrijfsnaam',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'id',
                            sortField: 'id',
                            title: 'PalletNr',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'cropDate',
                            sortField: 'cropDate',
                            title: 'Plukdatum',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'articleAmount',
                            sortField: 'articleAmount',
                            title: 'Aantal',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'article',
                            sortField: 'article',
                            title: 'Artikel',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }
                    ]
                },
                perPagePalletlabel: 20,
            }
        },
        watch: {
            data(newVal, oldVal) {
                this.$refs.artikels.refresh();
            },
            dataPalletlabel(newVal, oldVal) {
                this.$refs.palletlabels.refresh();
            },
        },
        computed: {
            // ...mapGetters(['getMenuType'])
            ...mapGetters({
                getMenuType: 'getMenuType',
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
                logisticIsLoading: 'logisticIsLoading'
            }),
            logistics() {
                return this.$store.getters.logistics;
            },
            logistic() {
                return this.$store.getters.logistic;
            },
            // planningTotal() {
            //     return this.$store.getters.planningTotal;
            // },
        },
        methods: {
            ...mapMutations(['changeAuthFarmer']),
            ...mapActions(['setFarmer']),
            changeFarmer(farmer) {
                this.setFarmer(farmer.uid);
                this.changeAuthFarmer(farmer);
                // this.getLogistic(farmer.id)

                this.$store.dispatch("getLogistic", farmer.id).then(() => {
                    this.data = this.logistic.totalArticles;
                    this.dataPalletlabel = this.logistic.totalLabels;
                    // this.getPlanningTotal();
                })

            },
            // getPlanningTotal() {
            //     this.$store.dispatch("getPlanningTotal");
            // },
            getAllLogistics() {
                this.$store.dispatch("getAllLogistics")
            },
            getLogistic(id) {
                this.$store.dispatch("getLogistic", id)
            },
            getArticlesById(id) {
                return this.$store.getters.articleById(id);
            },

            refreshButtonClick() {
                //console.log("refresh")
                // this.$emit('refreshMode')
            },
            // onPaginationData(paginationData) {
            //     this.$refs.pagination.setPaginationData(paginationData)
            // },
            // onChangePage(page) {
            //     this.$refs.artikels.changePage(page)
            // },

            dataManager(sortOrder, pagination) {
                if (this.data.length < 1) return;

                let local = this.data;

                // sortOrder can be empty, so we have to check for that as well
                if (sortOrder.length > 0) {
                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);
                    local = _.orderBy(
                        local,
                        sortOrder[0].sortField,
                        sortOrder[0].direction
                    );
                }

                pagination = this.$refs.artikels.makePagination(
                    local.length,
                    this.perPage
                );
                // console.log('pagination:', pagination)
                let from = pagination.from - 1;
                let to = from + this.perPage;

                return {
                    pagination: pagination,
                    data: _.slice(local, from, to)
                };
            },
            PalletlabeldataManager(sortOrder, pagination) {
                if (this.dataPalletlabel.length < 1) return;

                let local = this.dataPalletlabel;

                // sortOrder can be empty, so we have to check for that as well
                if (sortOrder.length > 0) {
                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);
                    local = _.orderBy(
                        local,
                        sortOrder[0].sortField,
                        sortOrder[0].direction
                    );
                }

                pagination = this.$refs.palletlabels.makePagination(
                    local.length,
                    this.perPagePalletlabel
                );
                // console.log('pagination:', pagination)
                let from = pagination.from - 1;
                let to = from + this.perPage;

                return {
                    pagination: pagination,
                    data: _.slice(local, from, to)
                };
            },

        },
        mounted() {
            // this.getAllLogistics();
            this.$store.dispatch("getLogistic", this.authFarmer.id).then(() => {
                this.data = this.logistic.totalArticles;
                this.dataPalletlabel = this.logistic.totalLabels;
                // this.getPlanningTotal();
            })
            // console.log(this.authFarmer.id);
            // this.getLogistic(this.authFarmer.id);
            // this.data = this.logistic.totalArticles;
            // this.dataPalletlabel = this.logistic.totalLabels;
        },
    }
</script>

<!--<script>-->
<!--    import {mapActions, mapGetters, mapMutations} from "vuex";-->
<!--    import VueTable from 'vuetable-2/src/components/Vuetable'-->
<!--    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'-->
<!--    import DoughnutShadowChart from "../../Charts/DoughnutShadow";-->

<!--    export default {-->
<!--        components: {-->
<!--            'doughnut-shadow-chart': DoughnutShadowChart,-->
<!--            VueTable,-->
<!--            VueTablePaginationBootstrap-->
<!--        },-->
<!--        name: "PlanningRead",-->
<!--        data() {-->
<!--            return {-->
<!--                waitLoad: false,-->
<!--                form: {-->
<!--                    cells: [],-->
<!--                },-->
<!--                delMode: false,-->
<!--                btnShow: '',-->
<!--                isChecked: '',-->
<!--                serverErrors: '',-->
<!--                updateMode: false,-->
<!--                dataPlanningArticles: [],-->
<!--                planningArticlesObj: {-->
<!--                    fields: [-->
<!--                        {-->
<!--                            name: 'article',-->
<!--                            sortField: 'article',-->
<!--                            title: 'Article',-->
<!--                            titleClass: '',-->
<!--                            dataClass: 'center aligned'-->
<!--                        },-->
<!--                        {-->
<!--                            name: 'amount',-->
<!--                            sortField: 'amount',-->
<!--                            title: 'Amount',-->
<!--                            titleClass: '',-->
<!--                            dataClass: 'center aligned'-->
<!--                        }-->

<!--                    ]-->
<!--                },-->
<!--                perPageplanningArticles: 10,-->

<!--                dataPlanningLabels: [],-->
<!--                planningLabelsObj: {-->
<!--                    fields: [-->
<!--                        {-->
<!--                            name: 'farmer',-->
<!--                            sortField: 'farmer',-->
<!--                            title: 'Farmer',-->
<!--                            titleClass: '',-->
<!--                            dataClass: 'center aligned'-->
<!--                        },-->
<!--                        {-->
<!--                            name: 'palletnr',-->
<!--                            sortField: 'palletnr',-->
<!--                            title: 'PalletNr',-->
<!--                            titleClass: '',-->
<!--                            dataClass: 'center aligned'-->
<!--                        },-->
<!--                        {-->
<!--                            name: 'cropdate',-->
<!--                            sortField: 'cropdate',-->
<!--                            title: 'Crop Date',-->
<!--                            titleClass: '',-->
<!--                            dataClass: 'center aligned'-->
<!--                        },-->
<!--                        {-->
<!--                            name: 'article',-->
<!--                            sortField: 'article',-->
<!--                            title: 'Article',-->
<!--                            titleClass: '',-->
<!--                            dataClass: 'center aligned'-->
<!--                        },-->
<!--                        {-->
<!--                            name: 'amount',-->
<!--                            sortField: 'amount',-->
<!--                            title: 'Amount',-->
<!--                            titleClass: '',-->
<!--                            dataClass: 'center aligned'-->
<!--                        }-->

<!--                    ]-->
<!--                },-->
<!--                perPageplanningLabels: 10,-->
<!--            }-->
<!--        },-->
<!--        watch: {-->
<!--            dataPlanningArticles(newVal, oldVal) {-->
<!--                this.$refs.planningArticlesList.refresh();-->
<!--            },-->
<!--            dataPlanningLabels(newVal, oldVal) {-->
<!--                this.$refs.planningLabelsList.refresh();-->
<!--            },-->
<!--        },-->
<!--        computed: {-->
<!--            // ...mapGetters(["authUser", "isAuthenticated"]),-->
<!--            ...mapGetters({-->
<!--                authFarmer: 'authFarmer',-->
<!--                authUserFarmers: 'authUserFarmers',-->
<!--                reportIsLoading: 'reportIsLoading'-->
<!--            }),-->
<!--            planning() {-->
<!--                return this.$store.getters.planning;-->
<!--            },-->
<!--        },-->
<!--        mounted() {-->
<!--            // this.getAllReports();-->
<!--            Promise.all([-->
<!--            this.$store.dispatch("getPlanning", this.authFarmer.id).then((response) => {-->
<!--                var ArticlesdataArr = [];-->
<!--                for (var key in this.planning.groupedarticles) {-->
<!--                    ArticlesdataArr.push({-->
<!--                        article: this.getArticlesById(parseInt(key)).name,-->
<!--                        amount: this.planning.groupedarticles[key]-->
<!--                    });-->
<!--                    // console.log("key " + key + " has value " + this.planning.groupedarticles[key]);-->
<!--                }-->

<!--                var LabelsdataArr = [];-->
<!--                for (var key in this.planning.labels) {-->
<!--                    // console.log(this.getFarmerById(parseInt(this.planning.labels[key].farmerId)));-->
<!--                    LabelsdataArr.push({-->
<!--                        farmer: this.getFarmerById(parseInt(this.planning.labels[key].farmerId)).name,-->
<!--                        palletnr: this.planning.labels[key].id,-->
<!--                        cropdate: this.planning.labels[key].cropDate,-->
<!--                        article: this.getArticlesById(parseInt(this.planning.labels[key].articleId)).name,-->
<!--                        amount: this.planning.labels[key].articleAmount,-->
<!--                    });-->
<!--                    // console.log("key " + key + " has value " + this.planning.groupedarticles[key]);-->
<!--                }-->

<!--                // console.log(dataArr);-->
<!--                // console.log(this.getFarmerById(parseInt(this.planning.labels[key].farmerId)).name);-->
<!--                this.dataPlanningArticles = ArticlesdataArr;-->
<!--                this.dataPlanningLabels = LabelsdataArr;-->
<!--                // this.dataPlanningLabels = this.planning.labels;-->
<!--                // console.log(this.dataPlanningArticles);-->
<!--            }),-->
<!--            this.getAllFarmers(),-->
<!--            this.getAllArticles(),-->
<!--        ]).finally(() => {});-->
<!--            this.waitLoad = true;-->
<!--        },-->
<!--        methods: {-->
<!--            ...mapMutations(['changeAuthFarmer']),-->
<!--            ...mapActions(['setFarmer']),-->
<!--            changeFarmer(farmer) {-->
<!--                Promise.all([-->
<!--                    this.setFarmer(farmer.uid),-->
<!--                    this.changeAuthFarmer(farmer)-->
<!--                ]).finally(() => {-->
<!--                    // this.getAllReports();-->
<!--                    // this.getAllReports();-->
<!--                });-->
<!--            },-->
<!--            getAllPlannings() {-->
<!--                this.$store.dispatch("getAllPlannings");-->
<!--            },-->
<!--            getOverzicht(id){-->
<!--                this.$store.dispatch("getPlanning", id)-->
<!--                    .then(() => {-->
<!--                        // console.log('hoi');-->
<!--                        // this.form = this.palletLabel;-->
<!--                    });-->
<!--            },-->
<!--            getAllArticles() {-->
<!--                this.$store.dispatch("getAllArticles");-->
<!--            },-->
<!--            getFarmerById(id) {-->
<!--                return this.$store.getters.farmerById(id);-->
<!--            },-->
<!--            getArticlesById(id) {-->
<!--                return this.$store.getters.articleById(id);-->
<!--            },-->
<!--            getAllFarmers() {-->
<!--                this.$store.dispatch("getAllFarmers");-->
<!--            },-->
<!--            refreshButtonClick() {-->
<!--                //console.log("refresh")-->
<!--                // this.$emit('refreshMode')-->
<!--            },-->
<!--            onPaginationDataArticles(paginationData) {-->
<!--                this.$refs.paginationArticles.setPaginationData(paginationData)-->
<!--            },-->
<!--            onChangePageArticles(page) {-->
<!--                this.$refs.planningArticlesList.changePage(page)-->
<!--            },-->
<!--            onPaginationDataLabels(paginationData) {-->
<!--                this.$refs.paginationLabels.setPaginationData(paginationData)-->
<!--            },-->
<!--            onChangePageLabels(page) {-->
<!--                this.$refs.planningLabelsList.changePage(page)-->
<!--            },-->

<!--            dataManagerplanningArticles(sortOrder, paginationArticles) {-->
<!--                // console.log('hoi' + pagination);-->
<!--                // console.log(this.dataPlanningArticles);-->
<!--                if (this.dataPlanningArticles.length < 1) return;-->

<!--                let local = this.dataPlanningArticles;-->

<!--                // sortOrder can be empty, so we have to check for that as well-->
<!--                if (sortOrder.length > 0) {-->
<!--                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);-->
<!--                    local = _.orderBy(-->
<!--                        local,-->
<!--                        sortOrder[0].sortField,-->
<!--                        sortOrder[0].direction-->
<!--                    );-->
<!--                }-->

<!--                paginationArticles = this.$refs.planningArticlesList.makePagination(-->
<!--                    local.length,-->
<!--                    this.perPageplanningArticles-->
<!--                );-->
<!--                // console.log('pagination:', paginationArticles)-->
<!--                let from = paginationArticles.from - 1;-->
<!--                let to = from + this.perPageplanningArticles;-->
<!--                // console.log('pagination:', pagination)-->
<!--                return {-->
<!--                    paginationArticles: paginationArticles,-->
<!--                    data: _.slice(local, from, to)-->
<!--                };-->
<!--            },-->

<!--            dataManagerplanningLabels(sortOrder, paginationLabels) {-->
<!--                if (this.dataPlanningLabels.length < 1) return;-->

<!--                let local = this.dataPlanningLabels;-->

<!--                // sortOrder can be empty, so we have to check for that as well-->
<!--                if (sortOrder.length > 0) {-->
<!--                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);-->
<!--                    local = _.orderBy(-->
<!--                        local,-->
<!--                        sortOrder[0].sortField,-->
<!--                        sortOrder[0].direction-->
<!--                    );-->
<!--                }-->

<!--                paginationLabels = this.$refs.planningLabelsList.makePagination(-->
<!--                    local.length,-->
<!--                    this.perPageplanningLabels-->
<!--                );-->
<!--                // console.log('pagination:', pagination)-->
<!--                let from = paginationLabels.from - 1;-->
<!--                let to = from + this.perPageplanningLabels;-->
<!--                // console.log('pagination:', pagination)-->
<!--                return {-->
<!--                    paginationLabels: paginationLabels,-->
<!--                    data: _.slice(local, from, to)-->
<!--                };-->
<!--            },-->
<!--        }-->
<!--    }-->
<!--</script>-->

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
