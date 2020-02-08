<template>
    <div>
        <b-refresh-button @click="refreshButtonClick" />
        <vue-table
            ref="shippinglabelList"
            :api-mode="false"
            :data="shippingLabels"
            :fields="shippinglabels.fields"
            :per-page="6"
            pagination-path=""
            @vuetable:pagination-data="onPaginationData"
        >
        <template slot="actions" scope="props">
          <div class="custom-actions">
            <!-- <b-button class="btn-sm" variant="primary"
              @click="onAction('edit-label', props.rowData, props.rowIndex)">
              <i class="simple-icon-note"></i>
            </b-button> -->
            <b-button class="btn-sm" variant="primary"
              @click="onAction('print-label', props.rowData, props.rowIndex)">
              <i class="simple-icon-printer"></i>
            </b-button>
          </div>
        </template>
        </vue-table>
        <vue-table-pagination-bootstrap
            ref="pagination"
            @vuetable-pagination:change-page="onChangePage"
        />
    </div>

</template>

<script>
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/VuetablePaginationBootstrap'

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
                shippinglabels: {
                    fields: [
                        {
                            name: 'shippinglabelId.id',
                            sortField: 'id',
                            title: '#',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'shippinglabelId.transportDate',
                            sortField: 'transportDate',
                            title: 'Transport',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'shippinglabelId.createdAt',
                            sortField: 'created',
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
                }
            }
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
            this.getAllShippingLabels();
        },
        methods: {
            onAction (action, data, index) {
              // console.log('slot) action: ' + action, data.id, index)
              // console.log('id: ' + data.id + ' ' + 'action: ' + action)
              if(action === 'print-label'){
                this.$router.push({name: 'shippinglabelPdf', params: {id: data.id}})
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
            },
            onPaginationData(paginationData){
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page){
                this.$refs.vueTable.changePage(page)
            }
        }
    }
</script>
