<template>
    <div v-if="waitLoad === true">
        <b-row>
            <b-colxx xl="4" lg="4" md="12" class="mb-4">
                <b-card no-body class="h-100">
                    <b-card-body>
                        <p class="lead color-theme-1 mb-1 value">{{ planning.totalpallets }} X</p>
                        <p class="mb-0 label text-small">{{$t('planning.totalpallets')}}</p>
                    </b-card-body>
                    <!--                    <b-card-body>-->
                    <!--                        <p class="lead color-theme-1 mb-1 value">{{ planning.avgpalletweight }} KG</p>-->
                    <!--                        <p class="mb-0 label text-small">{{$t('planning.avgpalletweight')}}</p>-->
                    <!--                    </b-card-body>-->
                    <!--                    <b-card-body>-->
                    <!--                        <p class="lead color-theme-1 mb-1 value">{{ planning.totalpalletweight }} KG</p>-->
                    <!--                        <p class="mb-0 label text-small">{{$t('planning.totalpalletweight')}}</p>-->
                    <!--                    </b-card-body>-->
                </b-card>
            </b-colxx>
            <b-colxx xl="8" lg="8" md="12" class="mb-4">
                <b-card class="h-100">
                    <div>
                        <b-refresh-button @click="refreshButtonClick"/>
                        <vue-table
                            ref="planningArticlesList"
                            :api-mode="false"
                            :fields="planningArticlesObj.fields"
                            :per-page="perPageplanningArticles"
                            :data-manager="dataManagerplanningArticles"
                            pagination-path="paginationArticles"
                            @vuetable:pagination-data="onPaginationDataArticles"
                        >
                        </vue-table>
                        <vue-table-pagination-bootstrap
                            ref="paginationArticles"
                            @vuetable-pagination:change-page="onChangePageArticles"
                        />
                    </div>
                </b-card>
            </b-colxx>
        </b-row>
    <b-row>
        <b-colxx xl="12" lg="12" md="12" class="mb-4">
            <b-card>
                <div>
                    <b-refresh-button @click="refreshButtonClick"/>
                    <vue-table
                        ref="planningLabelsList"
                        :api-mode="false"
                        :fields="planningLabelsObj.fields"
                        :per-page="perPageplanningLabels"
                        :data-manager="dataManagerplanningLabels"
                        pagination-path="paginationLabels"
                        @vuetable:pagination-data="onPaginationDataLabels"
                    >
                    </vue-table>
                    <vue-table-pagination-bootstrap
                        ref="paginationLabels"
                        @vuetable-pagination:change-page="onChangePageLabels"
                    />
                </div>
            </b-card>
        </b-colxx>
    </b-row>
</div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'
    import DoughnutShadowChart from "../../Charts/DoughnutShadow";

    export default {
        components: {
            'doughnut-shadow-chart': DoughnutShadowChart,
            VueTable,
            VueTablePaginationBootstrap
        },
        name: "PlanningRead",
        data() {
            return {
                waitLoad: false,
                form: {
                    cells: [],
                },
                delMode: false,
                btnShow: '',
                isChecked: '',
                serverErrors: '',
                updateMode: false,
                dataPlanningArticles: [],
                planningArticlesObj: {
                    fields: [
                        {
                            name: 'article',
                            sortField: 'article',
                            title: 'Article',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'amount',
                            sortField: 'amount',
                            title: 'Amount',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }

                    ]
                },
                perPageplanningArticles: 10,

                dataPlanningLabels: [],
                planningLabelsObj: {
                    fields: [
                        {
                            name: 'farmer',
                            sortField: 'farmer',
                            title: 'Farmer',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'palletnr',
                            sortField: 'palletnr',
                            title: 'PalletNr',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'cropdate',
                            sortField: 'cropdate',
                            title: 'Crop Date',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'article',
                            sortField: 'article',
                            title: 'Article',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'amount',
                            sortField: 'amount',
                            title: 'Amount',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }

                    ]
                },
                perPageplanningLabels: 10,
            }
        },
        watch: {
            dataPlanningArticles(newVal, oldVal) {
                this.$refs.planningArticlesList.refresh();
            },
            dataPlanningLabels(newVal, oldVal) {
                this.$refs.planningLabelsList.refresh();
            },
        },
        computed: {
            // ...mapGetters(["authUser", "isAuthenticated"]),
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
                reportIsLoading: 'reportIsLoading'
            }),
            planning() {
                return this.$store.getters.planning;
            },
        },
        mounted() {
            // this.getAllReports();
            Promise.all([
            this.$store.dispatch("getPlanning", this.authFarmer.id).then((response) => {
                var ArticlesdataArr = [];
                for (var key in this.planning.groupedarticles) {
                    ArticlesdataArr.push({
                        article: this.getArticlesById(parseInt(key)).name,
                        amount: this.planning.groupedarticles[key]
                    });
                    // console.log("key " + key + " has value " + this.planning.groupedarticles[key]);
                }

                var LabelsdataArr = [];
                for (var key in this.planning.labels) {
                    // console.log(this.getFarmerById(parseInt(this.planning.labels[key].farmerId)));
                    LabelsdataArr.push({
                        farmer: this.getFarmerById(parseInt(this.planning.labels[key].farmerId)).name,
                        palletnr: this.planning.labels[key].id,
                        cropdate: this.planning.labels[key].cropDate,
                        article: this.getArticlesById(parseInt(this.planning.labels[key].articleId)).name,
                        amount: this.planning.labels[key].articleAmount,
                    });
                    // console.log("key " + key + " has value " + this.planning.groupedarticles[key]);
                }

                // console.log(dataArr);
                // console.log(this.getFarmerById(parseInt(this.planning.labels[key].farmerId)).name);
                this.dataPlanningArticles = ArticlesdataArr;
                this.dataPlanningLabels = LabelsdataArr;
                // this.dataPlanningLabels = this.planning.labels;
                // console.log(this.dataPlanningArticles);
            }),
            this.getAllFarmers(),
            this.getAllArticles(),
        ]).finally(() => {});
            this.waitLoad = true;
        },
        methods: {
            ...mapMutations(['changeAuthFarmer']),
            ...mapActions(['setFarmer']),
            changeFarmer(farmer) {
                Promise.all([
                    this.setFarmer(farmer.uid),
                    this.changeAuthFarmer(farmer)
                ]).finally(() => {
                    // this.getAllReports();
                    // this.getAllReports();
                });
            },
            getAllPlannings() {
                this.$store.dispatch("getAllPlannings");
            },
            getOverzicht(id){
                this.$store.dispatch("getPlanning", id)
                    .then(() => {
                        // console.log('hoi');
                        // this.form = this.palletLabel;
                    });
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            getFarmerById(id) {
                return this.$store.getters.farmerById(id);
            },
            getArticlesById(id) {
                return this.$store.getters.articleById(id);
            },
            getAllFarmers() {
                this.$store.dispatch("getAllFarmers");
            },
            refreshButtonClick() {
                //console.log("refresh")
                // this.$emit('refreshMode')
            },
            onPaginationDataArticles(paginationData) {
                this.$refs.paginationArticles.setPaginationData(paginationData)
            },
            onChangePageArticles(page) {
                this.$refs.planningArticlesList.changePage(page)
            },
            onPaginationDataLabels(paginationData) {
                this.$refs.paginationLabels.setPaginationData(paginationData)
            },
            onChangePageLabels(page) {
                this.$refs.planningLabelsList.changePage(page)
            },

            dataManagerplanningArticles(sortOrder, paginationArticles) {
                // console.log('hoi' + pagination);
                // console.log(this.dataPlanningArticles);
                if (this.dataPlanningArticles.length < 1) return;

                let local = this.dataPlanningArticles;

                // sortOrder can be empty, so we have to check for that as well
                if (sortOrder.length > 0) {
                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);
                    local = _.orderBy(
                        local,
                        sortOrder[0].sortField,
                        sortOrder[0].direction
                    );
                }

                paginationArticles = this.$refs.planningArticlesList.makePagination(
                    local.length,
                    this.perPageplanningArticles
                );
                // console.log('pagination:', paginationArticles)
                let from = paginationArticles.from - 1;
                let to = from + this.perPageplanningArticles;
                // console.log('pagination:', pagination)
                return {
                    paginationArticles: paginationArticles,
                    data: _.slice(local, from, to)
                };
            },

            dataManagerplanningLabels(sortOrder, paginationLabels) {
                if (this.dataPlanningLabels.length < 1) return;

                let local = this.dataPlanningLabels;

                // sortOrder can be empty, so we have to check for that as well
                if (sortOrder.length > 0) {
                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);
                    local = _.orderBy(
                        local,
                        sortOrder[0].sortField,
                        sortOrder[0].direction
                    );
                }

                paginationLabels = this.$refs.planningLabelsList.makePagination(
                    local.length,
                    this.perPageplanningLabels
                );
                // console.log('pagination:', pagination)
                let from = paginationLabels.from - 1;
                let to = from + this.perPageplanningLabels;
                // console.log('pagination:', pagination)
                return {
                    paginationLabels: paginationLabels,
                    data: _.slice(local, from, to)
                };
            },
        }
    }
</script>

<style scoped>

</style>
