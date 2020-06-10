<template>
    <form class="needs-validation" @submit.prevent="validateBeforeSubmit">

        <!--        <b-dropdown id="farmer" class="ml-2" variant="light" size="sm" toggle-class="language-button">-->
        <!--            <template slot="button-content">-->
        <!--                <span class="name">{{authFarmer.name}}</span>-->
        <!--            </template>-->
        <!--            <b-dropdown-item v-for="(farmer,index) in authUserFarmers" :key="index"-->
        <!--                             @click="changeFarmer(farmer)">{{farmer.name}}-->
        <!--            </b-dropdown-item>-->
        <!--        </b-dropdown>-->
        <!--{{wait}}-->
        <div v-if="wait === false" id="">
            <b-row>
                <b-colxx xxs="4" class="mb-4">
                    <b-card no-body>
                        <b-card-body>
                            <p class="lead color-theme-1 mb-1 value" v-for="data in reports.data.totalLabelsCount">{{data.totalLabels}} X</p>
                            <p class="mb-0 label text-small">{{$t('report.totalpallets')}}</p>
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="4" class="mb-4">
                    <b-card no-body>
                        <b-card-body>
                            <p class="lead color-theme-1 mb-1 value" v-for="data in reports.data.avgWeight">{{data.avg}} KG</p>
                            <p class="mb-0 label text-small">{{$t('report.avgweight')}}</p>
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="4" class="mb-4">
                    <b-card no-body>
                        <b-card-body>
                            <p class="lead color-theme-1 mb-1 value" v-for="data in reports.data.totalWeight">{{data.weight}} KG</p>
                            <p class="mb-0 label text-small">{{$t('report.totalweight')}}</p>
                        </b-card-body>
                    </b-card>
                </b-colxx>
            </b-row>
            <b-row>
                <b-colxx xl="4" lg="4" md="12" class="mb-4">
                    <b-card class="h-100" :title="$t('report.chart.title')">
                        <div class="dashboard-donut-chart">
                            <doughnut-shadow-chart :height="300"/>
                        </div>
                    </b-card>
                </b-colxx>
                <b-colxx xl="8" lg="8" md="12" class="mb-4">
                    <b-card class="h-100">
                        <!--                        <b-refresh-button @click="checkPrint"/>-->
                        <vue-table id="printMe"
                                   table-height="360px"
                                   ref="reportList"
                                   :api-mode="false"
                                   :fields="reportsObj.fields"
                                   :per-page="perPage"
                                   :data-manager="dataManager"
                                   pagination-path="pagination"
                        >
                        </vue-table>
                        <br>
                        <hr>
                            <b-button style="float: right" @click="checkPrint">Print</b-button>
                    </b-card>
                </b-colxx>
            </b-row>
        </div>
        <div v-else>
            <br>
            <br>
            <br>
            <br>
            <div class="loading"></div>
        </div>
    </form>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";
    import DoughnutShadowChart from '../../../components/Charts/DoughnutShadow'
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'

    export default {
        components: {
            'doughnut-shadow-chart': DoughnutShadowChart,
            VueTable,
            VueTablePaginationBootstrap
        },
        name: "ReportRead",
        data() {
            return {
                form: {
                    cells: [],
                },
                wait: true,
                delMode: false,
                btnShow: '',
                isChecked: '',
                serverErrors: '',
                updateMode: false,
                data: [],
                reportsObj: {
                    fields: [
                        {
                            name: 'id',
                            sortField: 'id',
                            title: 'Limax ID',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'palletLabelFarmerId',
                            sortField: 'palletLabelFarmerId',
                            title: 'ID',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'cropDate',
                            sortField: 'cropDate',
                            title: 'Crop Date',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'articleAmount',
                            sortField: 'articleAmount',
                            title: 'Article Amount',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'sort',
                            sortField: 'sort',
                            title: 'Sort',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'weight',
                            sortField: 'weight',
                            title: 'Weight (kg)',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'note',
                            sortField: 'note',
                            title: 'Note',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'status',
                            sortField: 'status',
                            title: 'Status',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'cell',
                            sortField: 'cell',
                            title: 'Cell',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }

                    ]
                },
                perPage: 60,
            }
        },
        watch: {
            data(newVal, oldVal) {
                this.$refs.reportList.refresh();
            },
        },
        computed: {
            // ...mapGetters(["authUser", "isAuthenticated"]),
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
                reportIsLoading: 'reportIsLoading'
            }),
            reports() {
                return this.$store.getters.reports;
            }
        },
        mounted() {
            // this.getAllReports();
            this.$store.dispatch("getAllReports").then((response) => {
                if (this.reports.data.totalLabels){
                    this.data = this.reports.data.totalLabels;
                    this.wait = false;
                } else {
                    this.wait = true;
                }

                // console.log(this.reports);
                //console.log(this.data);
            });
        },
        methods: {
            ...mapMutations(['changeAuthFarmer']),
            ...mapActions(['setFarmer']),
            changeFarmer(farmer) {
                Promise.all([
                    this.setFarmer(farmer.uid),
                    this.changeAuthFarmer(farmer)
                ]).finally(() => {
                    this.getAllReports();
                });
            },
            getAllReports() {
                this.$store.dispatch("getAllReports")
                    .then(() => {
                        // console.log(this.reports);
                        // this.form.cells = this.cells;
                    });
            },
            checkPrint(printMe) {
                this.$htmlToPaper('printMe');
            },
            refreshButtonClick() {
                //console.log("refresh")
                // this.$emit('refreshMode')
            },
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page) {
                this.$refs.reportList.changePage(page)
            },

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

                pagination = this.$refs.reportList.makePagination(
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
        }
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
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
            visibility: hidden;
        }
    }
</style>
