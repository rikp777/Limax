<template>
    <div class="container-fluid">
        <div>
            <div class="row">
                <b-colxx xxs="3">
                    <b-card class="mb-4">
                        <b-card-header>
                            <h4 style="display: inline">Vrachtbrieven</h4>
                        </b-card-header>
                        <b-card-body>
                            <vue-table
                                table-height="360px"
                                ref="vrachtbrieven"
                                :api-mode="false"
                                :fields="vrachtbrieven.fields"
                                :per-page="perPagevrachtbrieven"
                                @vuetable:row-clicked="onRowClicked"
                                :data-manager="dataManagervrachtbrieven"
                                pagination-path="pagination"
                            >
                            </vue-table>
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="4">
                    <b-card class="mb-4">
                        <b-card-header>
                            <h4 style="display: inline">{{'Artikellen vrachtbrief ' + selectedRow}}</h4>
                        </b-card-header>
                        <b-card-body>
                            <vue-table
                                table-height="360px"
                                ref="artikelsdetail"
                                :api-mode="false"
                                :fields="detailObj.fields"
                                :per-page="perPagedetail"
                                :data-manager="dataManagerdetail"
                                pagination-path="pagination"
                            >
                            </vue-table>
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="5">
                    <b-card class="mb-4">
                        <b-card-header>
                            <h4 style="display: inline">{{'Pallets vrachtbrief ' + selectedRow}}</h4>
                        </b-card-header>
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
    </div>
</template>

<script>
    import vSelect from "vue-select";
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'
    import {
        mapActions,
        mapGetters, mapMutations
    } from 'vuex';

    export default {
        name: "Transport",
        components: {
            VueTable,
            VueTablePaginationBootstrap,
        },
        data() {
            return {
                data: [],
                dataDetail: [],
                datavrachtbrieven: [],
                reportsObj: {
                    fields: [
                        {
                            name: 'id',
                            sortField: 'id',
                            title: 'ID',
                            titleClass: '',
                            dataClass: 'center aligned',
                            width: "15%",
                        },
                        {
                            name: 'farmer',
                            sortField: 'farmer',
                            title: 'Farmer',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
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
                            dataClass: 'center aligned',
                            width: "15%",
                        }
                    ]
                },
                vrachtbrieven: {
                    fields: [
                        {
                            name: 'id',
                            sortField: 'id',
                            title: 'ID',
                            titleClass: '',
                            dataClass: 'center aligned',
                            width: "15%",
                        },
                        {
                            name: 'driver',
                            sortField: 'driver',
                            title: 'Chauffeur',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'createdAt',
                            sortField: 'createdAt',
                            title: 'Date',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }
                    ]
                },
                detailObj: {
                    fields: [
                        {
                            name: 'farmer',
                            sortField: 'farmer',
                            title: 'Farmer',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
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
                            dataClass: 'center aligned',
                            width: "15%",
                        }
                    ]
                },
                perPage: 20,
                perPagedetail: 20,
                perPagevrachtbrieven: 20,
                selectedRow: [],
            }
        },
        watch: {
            data(newVal, oldVal) {
                this.$refs.artikels.refresh();
            },
            datavrachtbrieven(newVal, oldVal) {
                this.$refs.vrachtbrieven.refresh();
            },
            dataDetail(newVal, oldVal) {
                this.$refs.artikelsdetail.refresh();
            },
        },
        computed: {
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
                TransportIsLoading: 'TransportIsLoading'
            }),
            transports() {
                return this.$store.getters.transports;
            },
            transport() {
                return this.$store.getters.transport;
            },
        },
        methods: {
            ...mapMutations(['changeAuthFarmer']),
            ...mapActions(['setFarmer']),
            getAllTransports() {
                this.$store.dispatch("getAllTransports");
            },
            onRowClicked (row) {
                console.log(this.$refs.vrachtbrieven);
                this.$store.dispatch("getTransport", row.id).then(()=>{
                    this.selectedRow = row.id
                    this.data = this.transport.totalLabels;
                    this.dataDetail = this.transport.detailLabels;
                    // this.onRowClass(row, row.id, 'bg-primary')
                    // console.log(this.$refs.vrachtbrieven)
                    // this.$refs.vrachtbrieven.rowClass = 'bg-primary'
                    // console.log(this.data);
                    // console.log(this.dataDetail);
                });
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
            dataManagerdetail(sortOrder, pagination) {
                if (this.dataDetail.length < 1) return;

                let local = this.dataDetail;

                // sortOrder can be empty, so we have to check for that as well
                if (sortOrder.length > 0) {
                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);
                    local = _.orderBy(
                        local,
                        sortOrder[0].sortField,
                        sortOrder[0].direction
                    );
                }

                pagination = this.$refs.artikelsdetail.makePagination(
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
            dataManagervrachtbrieven(sortOrder, pagination) {
                if (this.datavrachtbrieven.length < 1) return;

                let local = this.datavrachtbrieven;

                // sortOrder can be empty, so we have to check for that as well
                if (sortOrder.length > 0) {
                    // console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);
                    local = _.orderBy(
                        local,
                        sortOrder[0].sortField,
                        sortOrder[0].direction
                    );
                }

                pagination = this.$refs.vrachtbrieven.makePagination(
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
        },
        mounted() {
            Promise.all([
                // this.getAllTransports()
                this.$store.dispatch("getAllTransports").then(()=>{
                    this.datavrachtbrieven = this.transports.data
                })
            ]).finally(() => {
                this.datavrachtbrieven = this.transports.data
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
