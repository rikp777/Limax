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

        <b-row>
            <b-colxx xxs="4" class="mb-4">
                <b-card no-body>
                    <b-card-body>
                        <p class="lead color-theme-1 mb-1 value">{{reports.totalpallets}} X</p>
                        <p class="mb-0 label text-small">{{$t('report.totalpallets')}}</p>
                    </b-card-body>
                </b-card>
            </b-colxx>
            <b-colxx xxs="4" class="mb-4">
                <b-card no-body>
                    <b-card-body>
                        <p class="lead color-theme-1 mb-1 value">{{reports.avgpalletweight}} KG</p>
                        <p class="mb-0 label text-small">{{$t('report.avgweight')}}</p>
                    </b-card-body>
                </b-card>
            </b-colxx>
            <b-colxx xxs="4" class="mb-4">
                <b-card no-body>
                    <b-card-body>
                        <p class="lead color-theme-1 mb-1 value">{{reports.totalpalletweight}} KG</p>
                        <p class="mb-0 label text-small">{{$t('report.totalweight')}}</p>
                    </b-card-body>
                </b-card>
            </b-colxx>
        </b-row>
        <!--        </b-colxx>-->
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
                    <div class="dashboard-donut-chart">
                        <b-refresh-button @click="refreshButtonClick"/>
                        <vue-table
                            ref="reportList"
                            :api-mode="false"
                            :fields="reportsObj.fields"
                            :per-page="perPage"
                            :data-manager="dataManager"
                            pagination-path="pagination"
                            @vuetable:pagination-data="onPaginationData"
                        >
                        </vue-table>
                        <vue-table-pagination-bootstrap
                            ref="pagination"
                            @vuetable-pagination:change-page="onChangePage"
                        />
                    </div>
                </b-card>
            </b-colxx>
        </b-row>
    </form>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from "vuex";
    import DoughnutShadowChart from '../../../components/Charts/DoughnutShadow'
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/VuetablePaginationBootstrap'

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
                            title: '#',
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
                            title: 'Weight',
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
                            name: 'statusDescription',
                            sortField: 'statusDescription',
                            title: 'Status',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'cellDescription',
                            sortField: 'cellDescription',
                            title: 'Cell',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }

                    ]
                },
                perPage: 4,
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
                this.data = this.reports.labels;
                console.log(this.data);
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

            refreshButtonClick() {
                console.log("refresh")
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

</style>
