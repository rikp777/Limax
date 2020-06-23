<template>
    <div>
        <b-refresh-button @click="refreshButtonClick"/>
        <vue-table
            ref="farmerSortList"
            :api-mode="false"
            :fields="farmersorts.fields"
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

</template>

<script>
    // TODO
    // This component has a list of all the articles for a specific farmer
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'

    import {mapGetters} from 'vuex';

    export default {
        name: "FarmerSortList",
        components: {
            VueTable,
            VueTablePaginationBootstrap
        },
        props: ['sortId'],
        data() {
            return {
                data: [],
                farmersorts: {
                    fields: [
                        {
                            name: 'id',
                            sortField: 'id',
                            title: '#',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'description',
                            sortField: 'description',
                            title: 'Description',
                            titleClass: '',
                            dataClass: 'center aligned'
                        }

                    ]
                },
                perPage: 3,
            }
        },
        watch: {
            data(newVal, oldVal) {
                this.$refs.farmerSortList.refresh();
            },
        },
        computed: {
            sortfarmers() {
                return this.$store.getters.sortfarmers;
            },
            isLoading() {
                return this.$store.getters.sortfarmerIsLoading
            },
        },
        mounted() {
            // this.getAllArticleFarmers();
            this.$store.dispatch("getAllSortFarmers").then((response) => {
                this.data = this.sortfarmers;
            });
        },
        methods: {
            getAllSortFarmers() {
                this.$store.dispatch("getAllSortFarmers");
            },

            refreshButtonClick() {
                console.log("refresh")
                this.$emit('refreshMode')
            },
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page) {
                this.$refs.farmerSortList.changePage(page)
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

                pagination = this.$refs.farmerSortList.makePagination(
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
