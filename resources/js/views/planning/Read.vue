<template>
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

</template>

<script>
    import Sidebar from '../../../containers/menu/logistics/Sidebar'
    import TopNav from '../../../containers/menu/logistics/TopNav'
    import Footer from '../../../containers/Footer'
    import {
        mapActions,
        mapGetters, mapMutations
    } from 'vuex'
    import DarkMode from "../../../components/menu/DarkMode";
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'
    import planningTotal from "../../../components/crudl/planning/PlanningTotal";

    export default {
        components: {
            DarkMode,
            'top-nav': TopNav,
            'sidebar': Sidebar,
            'footer-component': Footer,
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

<style scoped>

</style>
