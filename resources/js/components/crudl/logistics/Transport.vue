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
<!--                            {{transports}}-->
                                    <b-table
                                        ref="custom-table"
                                        class="vuetable"
                                        @row-selected="rowSelected"
                                        selectable
                                        :select-mode="bootstrapTable.selectMode"
                                        selectedVariant="light"
                                        :fields="bootstrapTable.fields"
                                        :items="bootstrapTable.items"
                                    >
<!--                                        <template slot="status" slot-scope="data">-->
<!--                                            <b-badge class="mb-1" :variant="data.item.statusColor">{{ data.value }}</b-badge>-->
<!--                                        </template>-->
                                    </b-table>
<!--                                    <b-alert v-if="bootstrapTable.selected.length>0" show variant="primary"><br/><pre>{{ bootstrapTable.selected }}</pre></b-alert>-->
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="4">
                    <b-card class="mb-4">
                        <b-card-header>
                            <h4 style="display: inline">{{'Artikellen vrachtbrief ' + bootstrapTable.selected}}</h4>
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
                            <h4 style="display: inline">{{'Pallets vrachtbrief ' + bootstrapTable.selected}}</h4>
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
<!--        <div v-else>-->
<!--            <b-jumbotron header="Transport" lead="">-->

<!--            </b-jumbotron>-->
<!--        </div>-->
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
                reportsObj: {
                    fields: [
                        {
                            name: 'farmer',
                            sortField: 'farmer',
                            title: 'Farmer',
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
                        },
                        {
                            name: 'id',
                            sortField: 'id',
                            title: 'ID',
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
                perPage: 20,
                perPagedetail: 20,
                bootstrapTable: {
                    selected: [],
                    selectMode: 'single',
                    fields: [
                        { key: 'id', label: 'ID'},
                        { key: 'driver', label: 'Chauffeur'},
                        { key: 'createdAt', label: 'Date'}
                    ],
                    items: []
                }
            }
        },
        watch: {
            data(newVal, oldVal) {
                this.$refs.artikels.refresh();
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
            rowSelected (items) {
                // console.log(items['0'])
                this.$store.dispatch("getTransport", items['0'].id).then(()=>{
                    this.bootstrapTable.selected = items['0'].id
                    this.data = this.transport.totalLabels;
                    this.dataDetail = this.transport.detailLabels;
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
        },
        mounted() {
            // console.log('hoi');
            this.getAllTransports();
            this.bootstrapTable.items = this.transports.data;
            // console.log(this.bootstrapTable.items);
            // console.log(this.transports);
            // this.transports.data.forEach(element => console.log(element));
            // console.log(this.bootstrapTable.items);
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
