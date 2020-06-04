<template>
    <div>
        <b-refresh-button @click="refreshButtonClick" />
        <vue-table
            ref="shippinglabelList"
            :api-mode="false"
            :fields="shippinglabels.fields"
            :per-page="perPage"
            :data-manager="dataManager"
            pagination-path="pagination"
            @vuetable:pagination-data="onPaginationData"
        >
        <template slot="actions" scope="props">
          <div class="custom-actions">
            <b-button class="btn-sm" variant="primary"
              @click="onAction('print-label', props.rowData, props.rowIndex)">
              <i class="simple-icon-printer"></i>
            </b-button>
              <b-button class="btn-sm" variant="primary" data-toggle="modal"
                        @click="shippinglabelReset(props.rowData.shippinglabelId.id, props.rowIndex)">
                  <i class="simple-icon-trash"></i>
              </b-button>
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
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'

    import { mapGetters } from 'vuex';
    export default {
        name: "FarmerShippinglabelList",
        components: {
            VueTable,
            VueTablePaginationBootstrap
        },
        props: ['farmerId'],
        data() {
            return {
                data: [],
                shippinglabels: {
                    fields: [
                        {
                            name: 'shippinglabelId.id',
                            sortField: 'shippinglabelId.id',
                            title: '#',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'shippinglabelId.transportDate',
                            sortField: 'shippinglabelId.transportDate',
                            title: 'Transport',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'shippinglabelId.createdAt',
                            sortField: 'shippinglabelId.createdAt',
                            title: 'Created',
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
                this.$refs.shippinglabelList.refresh();
            },
        },
        computed: {
            shippingLabels(){
                return this.$store.getters.shippingLabels
            },
            isLoading(){
                return this.$store.getters.shippingLabelIsLoading
            },
        },
        mounted() {
            // this.getAllShippingLabels();
            this.$store.dispatch("getAllShippingLabels").then((response) => {
                this.data = this.shippingLabels.data;
            });
        },
        methods: {
            shippinglabelReset(id, index) {
                console.log(id)
                // this.$emit('deleteMode')
                this.$swal({
                    title: this.$t('shippinglabel.delete.title'),
                    text: this.$t('shippinglabel.delete.text'),
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f2ab59",
                    confirmButtonText: this.$t('shippinglabel.delete.actions.confirmButtonText'),
                    cancelButtonText: this.$t('shippinglabel.delete.actions.cancelButtonText'),
                }).then((confirmed) => {
                    if (confirmed.value) {
                        this.$swal(
                            this.$t('shippinglabel.delete.deleted'),
                            this.$t('shippinglabel.delete.deletedtext'),
                            'success'
                        );
                        Promise.all([
                            this.$store.dispatch("shippinglabelReset", id)
                        ]).finally(() => {
                            // this.getAllPalletLabels();
                            this.$store.dispatch("getAllShippingLabels").then((response) => {
                                this.data = this.shippingLabels.data;
                                this.$emit('deleteMode')
                            });
                        })
                    } else {
                        this.$swal(
                            this.$t('shippinglabel.delete.cancelled'),
                            this.$t('shippinglabel.delete.cancelledtext'),
                            "error"
                        );
                    }
                });
            },
            onAction (action, data, index) {
              // console.log('slot) action: ' + action, data, index)
              // console.log('id: ' + data.id + ' ' + 'action: ' + action)
              if(action === 'print-label'){
                  // console.log(data.shippinglabelId.id)
                this.$router.push({name: 'shippinglabelPdf', params: {id: data.shippinglabelId.id}})
              }
              if(action === 'edit-label'){
                this.$emit('updateMode', data.id)
                console.log(action)
              }
            },
            getAllShippingLabels(){
                this.$store.dispatch("getAllShippingLabels");
            },

            refreshButtonClick(){
                console.log("refresh")
                this.$emit('refreshMode')
            },
            onPaginationData(paginationData){
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page){
                this.$refs.shippinglabelList.changePage(page)
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

                pagination = this.$refs.shippinglabelList.makePagination(
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
