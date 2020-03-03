<template>
        <div>
            <b-refresh-button @click="refreshButtonClick"/>
            <vue-table
                ref="UsersList"
                :api-mode="false"
                :fields="users.fields"
                :per-page="perPage"
                :data-manager="dataManager"
                pagination-path="pagination"
                @vuetable:pagination-data="onPaginationData"
            >
                <template slot="actions" scope="props">
                    <div class="custom-actions">
                        <b-button class="btn-sm" variant="primary"
                                  @click="onAction('edit-user', props.rowData, props.rowIndex)">
                            <i class="simple-icon-note"></i>
                        </b-button>
                        <b-button class="btn-sm" variant="primary" data-toggle="modal"
                                  @click="userDelete(props.rowData.id, props.rowIndex)">
                            <i class="simple-icon-trash"></i>
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
    // TODO
    //
    //  Hier worden users getoond van de gehele applicatie en minimalitisch de bijbehorende eigenschappen
    //  zoals gekoppelde Farmers en/of Departments ook is het hier mogelijk om naar verdere acties te navigeren
    //
    //  *De User kan worden geblockeerd
    //  *De User kan navigeren naar de Read
    //  *De User kan navigeren naar de Update
    //
    //  */
    import VueTable from 'vuetable-2/src/components/Vuetable'
    import VueTablePaginationBootstrap from '../../../components/Common/VuetablePaginationBootstrap'

    import {mapGetters} from 'vuex';

    export default {
        name: "UserList",
        components: {
            VueTable,
            VueTablePaginationBootstrap
        },
        props: ['farmerId'],
        data() {
            return {
                data: [],
                users: {
                    fields: [
                        {
                            name: 'id',
                            sortField: 'id',
                            title: '#',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'fullName',
                            sortField: 'fullName',
                            title: 'Full Name',
                            titleClass: '',
                            dataClass: 'center aligned'
                        },
                        {
                            name: 'email',
                            sortField: 'email',
                            title: 'Email',
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
                perPage: 6,
            }
        },
        watch: {
            data(newVal, oldVal) {
                this.$refs.UsersList.refresh();
            },
        },
        computed: {
            getUsers() {
                return this.$store.getters.users;
            },
            isLoading() {
                return this.$store.getters.articleIsLoading
            },
        },
        mounted() {
            // this.getAllUsers();
            this.$store.dispatch("getAllUsers").then((response) => {
                this.data = this.getUsers.data;
            });
        },
        methods: {
            // setPaginationData (){
            //   this.getUsers.meta;
            // },
            userDelete(id, index) {
                this.$swal({
                    title: this.$t('user.delete.title'),
                    text: this.$t('user.delete.text'),
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f2ab59",
                    confirmButtonText: this.$t('user.delete.actions.confirmButtonText'),
                    cancelButtonText: this.$t('user.delete.actions.cancelButtonText'),
                }).then((confirmed) => {
                    if (confirmed.value) {
                        this.$swal(
                            this.$t('user.delete.deleted'),
                            this.$t('user.delete.deletedtext'),
                            'success'
                        );
                        Promise.all([
                            this.$store.dispatch("deleteUser", id)
                        ]).finally(() => {
                            this.$store.dispatch("getAllUsers").then((response) => {
                                this.data = this.getUsers.data;
                            });
                            // this.getAllUsers();
                            // this.data = this.getUsers.data;
                            // this.dataManager();
                            // this.$refs.UsersList.refresh();
                        })
                    } else {
                        this.$swal(
                            this.$t('user.delete.cancelled'),
                            this.$t('user.delete.cancelledtext'),
                            "error"
                        );
                    }
                });
            },
            onAction(action, data, index) {
                if (action === 'edit-user') {
                    this.$emit('updateMode', data.id)
                    //console.log(action)
                }
            },
            getAllUsers() {
                this.$store.dispatch("getAllUsers");
            },

            refreshButtonClick() {
                //console.log("refresh")
            },
            onPaginationData(paginationData) {
                this.$refs.pagination.setPaginationData(paginationData)
            },
            onChangePage(page) {
                this.$refs.UsersList.changePage(page)
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

                pagination = this.$refs.UsersList.makePagination(
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
