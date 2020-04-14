<template>
    <b-card title="Palletlabel List">
        <b-refresh-button @click="refreshButtonClick" />
        <vue-table
            ref="palletlabelList"
            :api-mode="false"
            :data="palletLabels"
            :fields="palletlabels.fields"
            :per-page="6"
            pagination-path=""
            @vuetable:pagination-data="onPaginationData"
        />
        <vue-table-pagination-bootstrap
            ref="pagination"
            @vuetable-pagination:change-page="onChangePage"
        />
    </b-card>



<!--            <table class="table">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th class="text-left">#</th>-->
<!--                    <th>Name</th>-->
<!--                    <th class="text-right">Actions</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <template v-if="!palletLabels">-->
<!--                    <tr>-->
<!--                        <td colspan="4" class="text-center">No pallet labels Available</td>-->
<!--                    </tr>-->
<!--                </template>-->
<!--                <template v-else>-->
<!--                    <tr v-for="palletlabel in palletLabels" :key="palletlabel.id" v-if="articles.length">-->
<!--                        <td> {{ palletlabel.id}}</td>-->
<!--                        <td> {{ getArticlesById(palletlabel.articleId).name }}</td>-->
<!--                        <td class="td-actions text-right">-->
<!--                            <router-link class="btn btn-primary text-white" :to="{ name: 'palletLabelUpdate', params: { id: palletlabel.id }}">Update</router-link>-->
<!--                            <router-link class="btn btn-primary text-white" :to="{ name: 'palletLabelPdf', params: { id: palletlabel.id }}">PDF</router-link>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                </template>-->
<!--                </tbody>-->
<!--            </table>-->
</template>

<script>
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../../components/Common/vuetablePaginationBootstrap'

    import { mapGetters } from 'vuex';
    export default {
        name: "Home",
        components: {
            VueTable,
            VueTablePaginationBootstrap
        },
        props: ['farmerId'],
        data() {
            return {
                palletlabels: {
                    fields: [
                        {
                            name: 'palletLabelFarmerId',
                            sortField: 'id',
                            title: '#',
                            titleClass: '',
                            dataClass: ''
                        },
                        {
                            name: 'article.name',
                            sortField: 'name',
                            title: 'Name',
                            titleClass: '',
                            dataClass: ''
                        },
                        {
                            name: 'cropDate',
                            sortField: 'cropDate',
                            title: 'Crop Date',
                            titleClass: '',
                            dataClass: ''
                        }
                    ]
                }
            }
        },
        computed: {
            palletLabels(){
                return this.$store.getters.palletLabels
            },
            isLoading(){
                return this.$store.getters.palletLabelIsLoading
            },
        },
        mounted() {
            this.getAllPalletLabels();
        },
        methods: {
            getAllPalletLabels(){
                this.$store.dispatch("getAllPalletLabels");
            },

            refreshButtonClick(){
                //console.log("refresh")
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


