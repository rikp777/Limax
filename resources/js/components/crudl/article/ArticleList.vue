<template>
    <div>
        <b-refresh-button @click="refreshButtonClick"/>
        <vue-table
            table-height="360px"
            ref="ArticleList"
            :api-mode="false"
            :fields="articles.fields"
            :per-page="perPage"
            :data-manager="dataManager"
            pagination-path="pagination"
            @vuetable:pagination-data="onPaginationData"
        >
            <template slot="actions" scope="props">
                <div class="custom-actions">
                    <b-button class="btn-sm" variant="primary"
                              @click="onAction('edit-article', props.rowData, props.rowIndex)">
                        <i class="simple-icon-note"></i>
                    </b-button>
<!--                    <b-button class="btn-sm" variant="primary" data-toggle="modal"-->
<!--                              @click="articleDelete(props.rowData.id, props.rowIndex)">-->
<!--                        <i class="simple-icon-trash"></i>-->
<!--                    </b-button>-->
                </div>
            </template>
        </vue-table>
<!--        <vue-table-pagination-bootstrap-->
<!--            ref="pagination"-->
<!--            @vuetable-pagination:change-page="onChangePage"-->
<!--        />-->
    </div>
</template>



<script>
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/vuetablePaginationBootstrap'
    export default {
        name: "ArticleList",
        components: {
            VueTable,
            VueTablePaginationBootstrap
        },
        props: ['articleId'],
        data() {
            return {
                data: [],
                articles: {
                    fields: [
                        {
                            name: 'id',
                            sortField: 'id',
                            title: '#',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'excelCode',
                            sortField: 'excelCode',
                            title: 'Excel Code',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'name',
                            sortField: 'name',
                            title: 'Name',
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
                perPage: 210,
            }
        },
        watch: {
            data(newVal, oldVal) {
                this.$refs.ArticleList.refresh();
            },
        },
        computed: {
            getArticles() {
                return this.$store.getters.articles;
            },
            isLoading() {
                return this.$store.getters.articleIsLoading
            },
        },
        mounted() {
            // this.getAllUsers();
            this.$store.dispatch("getAllArticles").then((response) => {
                this.data = this.getArticles;
            });
        },
        methods: {
            // setPaginationData (){
            //   this.getUsers.meta;
            // },
            articleDelete(id, index) {
                this.$store.dispatch("deleteArticle", id);
                console.log(id);
                // this.$swal({
                //     title: this.$t('article.delete.title'),
                //     text: this.$t('article.delete.text'),
                //     type: "warning",
                //     showCancelButton: true,
                //     confirmButtonColor: "#f2ab59",
                //     confirmButtonText: this.$t('article.delete.actions.confirmButtonText'),
                //     cancelButtonText: this.$t('article.delete.actions.cancelButtonText'),
                // }).then((confirmed) => {
                //     if (confirmed.value) {
                //         this.$swal(
                //             this.$t('article.delete.deleted'),
                //             this.$t('article.delete.deletedtext'),
                //             'success'
                //         );
                //         Promise.all([
                //             this.$emit('refreshMode'),
                //             this.$store.dispatch("deleteArticle", id)
                //         ]).finally(() => {
                //             this.$store.dispatch("getAllArticles").then((response) => {
                //                 this.data = this.getArticles;
                //             });
                //             // this.getAllUsers();
                //             // this.data = this.getUsers.data;
                //             // this.dataManager();
                //             // this.$refs.UsersList.refresh();
                //         })
                //     } else {
                //         this.$swal(
                //             this.$t('article.delete.cancelled'),
                //             this.$t('article.delete.cancelledtext'),
                //             "error"
                //         );
                //     }
                // });
            },
            onAction(action, data, index) {
                if (action === 'edit-article') {
                    this.$emit('updateMode', data.id)
                    console.log(action)
                }
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },

            refreshButtonClick() {
                console.log("refresh")
            },
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page) {
                this.$refs.ArticleList.changePage(page)
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

                pagination = this.$refs.ArticleList.makePagination(
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
