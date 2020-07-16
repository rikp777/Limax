<template>
    <div>
        <b-refresh-button @click="refreshButtonClick"/>
        <vue-table
            ref="palletlabelList"
            :api-mode="false"
            :fields="palletlabels.fields"
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
                    <b-button class="btn-sm" variant="primary" :cy-test="props.rowIndex"
                              @click="onAction('edit-label', props.rowData, props.rowIndex)">
                        <i class="simple-icon-note"></i>
                    </b-button>
                    <b-button class="btn-sm" variant="primary"
                              @click="onAction('print-label', props.rowData, props.rowIndex)">
                        <i class="simple-icon-printer"></i>
                    </b-button>
                    <b-button class="btn-sm" variant="primary" data-toggle="modal"
                              @click="palletLabelDelete(props.rowData.id, props.rowIndex)">
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
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'

    import {mapGetters} from 'vuex';

    export default {
        name: "FarmerPalletlabelList",
        components: {
            VueTable,
            VueTablePaginationBootstrap
        },
        props: ['farmerId'],
        data() {
            return {
                data: [],
                palletlabels: {
                    fields: [
                        {
                            name: 'palletLabelFarmerId',
                            sortField: 'id',
                            title: '#',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'article.name',
                            sortField: 'article.name',
                            title: 'Name',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'articleAmount',
                            sortField: 'articleAmount',
                            title: 'Amount',
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
                this.$refs.palletlabelList.refresh();
            },
        },
        computed: {
            palletLabels() {
                return this.$store.getters.palletLabels
            },
            palletLabelsPaginated() {
                return this.$store.getters.palletLabelsPaginated
            },
            isLoading() {
                return this.$store.getters.palletLabelIsLoading
            },
        },
        mounted() {
            Promise.all([
                this.$store.dispatch("getAllPalletLabels").then((response) => {
                    //console.log('en nu data vullen');
                })
            ]).finally(() => {
                // console.log('ik kom naar de data gevuld is');
                // console.log(this.palletLabels);
                this.data = this.palletLabels;
            })

        },
        methods: {
            palletLabelDelete(id, index) {
                this.$swal({
                    title: this.$t('palletlabel.delete.title'),
                    text: this.$t('palletlabel.delete.text'),
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f2ab59",
                    confirmButtonText: this.$t('palletlabel.delete.actions.confirmButtonText'),
                    cancelButtonText: this.$t('palletlabel.delete.actions.cancelButtonText'),
                }).then((confirmed) => {
                    if (confirmed.value) {
                        this.$swal(
                            this.$t('palletlabel.delete.deleted'),
                            this.$t('palletlabel.delete.deletedtext'),
                            'success'
                        );
                        Promise.all([
                            this.$store.dispatch("deletePalletLabel", id)
                        ]).finally(() => {
                            // this.getAllPalletLabels();
                            this.$store.dispatch("getAllPalletLabels").then((response) => {
                                this.data = this.palletLabels.data;
                                this.$emit('deleteMode')
                            });
                        })
                    } else {
                        this.$swal(
                            this.$t('palletlabel.delete.cancelled'),
                            this.$t('palletlabel.delete.cancelledtext'),
                            "error"
                        );
                    }
                });
            },
            onAction(action, data, index) {
                // console.log('slot) action: ' + action, data.id, index)
                // console.log('id: ' + data.id + ' ' + 'action: ' + action)
                if (action === 'print-label') {
                    this.$router.push({name: 'palletlabelPdf', params: {id: data.id}})
                }
                if (action === 'edit-label') {
                    this.$emit('updateMode', data.id)
                    console.log(action)
                }
            },
            getAllPalletLabels() {
                this.$store.dispatch("getAllPalletLabels");
            },

            refreshButtonClick() {
                console.log("refresh")
                this.$emit('deleteMode')
            },
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page) {
                this.$refs.palletlabelList.changePage(page)
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

                pagination = this.$refs.palletlabelList.makePagination(
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
