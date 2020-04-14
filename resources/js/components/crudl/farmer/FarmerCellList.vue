<template>
    <div>
        <b-refresh-button @click="refreshButtonClick" />
        <vue-table
            ref="cellList"
            :api-mode="false"
            :fields="cells.fields"
            :per-page="perPage"
            :data-manager="dataManager"
            pagination-path="pagination"
            @vuetable:pagination-data="onPaginationData"
        >
            <!--            :per-page="6"-->
            <!--            pagination-path=""-->
            <!--            @vuetable:pagination-data="onPaginationData"-->
            <template slot="actions" scope="props">
                <div class="custom-actions">
                    <b-button class="btn-sm" variant="primary"
                      @click="onAction('edit-label', props.rowData, props.rowIndex)">
                      <i class="simple-icon-note"></i>
                    </b-button>
<!--                    <b-button class="btn-sm" variant="primary"-->
<!--                              @click="onAction('print-label', props.rowData, props.rowIndex)">-->
<!--                        <i class="simple-icon-printer"></i>-->
<!--                    </b-button>-->
                </div>
            </template>
        </vue-table>
        <vue-table-pagination-bootstrap
            ref="pagination"
            @vuetable-pagination:change-page="onChangePage"
        />
        <!--        <vue-table-pagination-bootstrap-->
        <!--            ref="pagination"-->
        <!--            @vuetable-pagination:change-page="onChangePage"-->
        <!--        />-->
    </div>

</template>

<script>
    // TODO
    // This component has a list of all the cells for a specific farmer
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'

    import { mapGetters } from 'vuex';
    export default {
        name: "FarmerCellList",
        components: {
            VueTable,
            VueTablePaginationBootstrap
        },
        props: ['farmerId'],
        data() {
            return {
                data: [],
                cells: {
                    fields: [
                        {
                            name: 'number',
                            sortField: 'number',
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
                        },
                        {
                            name: '__slot:actions',
                            title: 'Actions',
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
                this.$refs.cellList.refresh();
            },
        },
        computed: {
            getCells(){
                return this.$store.getters.cells
            },
            isLoading(){
                return this.$store.getters.cellIsLoading
            },
        },
        mounted() {
            // this.getAllCells();
            this.$store.dispatch("getAllCells").then((response) => {
                this.data = this.getCells;
            });
        },
        methods: {
            getAllCells() {
                this.$store.dispatch("getAllCells")
            },
            onAction (action, data, index) {
                // console.log('slot) action: ' + action, data.id, index)
                // console.log('id: ' + data.id + ' ' + 'action: ' + action)
                // if(action === 'print-label'){
                //     this.$router.push({name: 'shippinglabelPdf', params: {id: data.id}})
                // }
                if(action === 'edit-label'){
                    this.$emit('updateMode', data.id)
                    console.log(action)
                }
            },

            refreshButtonClick(){
                console.log("refresh")
                this.$emit('refreshMode')
            },
            onPaginationData(paginationData){
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page){
                this.$refs.cellList.changePage(page)
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

                pagination = this.$refs.cellList.makePagination(
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

