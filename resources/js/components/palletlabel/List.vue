<template>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th class="text-left">#</th>
                <th>Name</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="!palletLabels">
                <tr>
                    <td colspan="4" class="text-center">No pallet labels Available</td>
                </tr>
            </template>
            <template v-else>
<!--                {{palletLabels}}-->
                <tr v-for="(palletlabel,index) in palletLabelsPaginated" :key="palletlabel.id" v-if="articles.length">
<!--                    <td> {{ palletlabel}}</td>-->
                    <td> {{ palletlabel.palletLabelFarmerId}}</td>
                    <td> {{ getArticlesById(palletlabel.articleId).name }}</td>
                    <td class="td-actions text-right">
                        <router-link class="btn btn-primary text-white" :to="{ name: 'palletLabelPdf', params: { id: palletlabel.id }}">PDF</router-link>
                        <router-link class="btn btn-primary text-white" :to="{ name: 'palletLabelUpdate', params: { id: palletlabel.id }}">Update</router-link>
                        <button class="btn btn-primary text-white" data-toggle="modal" @click="palletLabelDelete(palletlabel.id, index)">Delete</button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>

    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        name: "Home",
        props: ['farmerId'],
        computed: {
            palletLabels(){
                return this.$store.getters.palletLabels
            },
            palletLabelsPaginated(){
                return this.$store.getters.palletLabelsPaginated
            },
            isLoading(){
                return this.$store.getters.palletLabelIsLoading
            },
            articles(){
                return this.$store.getters.articles
            }

        },
        mounted() {
            // console.log('test ' + this.farmerId);
            this.getAllPalletLabels();
            this.getAllArticles();
        },
        methods: {
            getArticlesById(id){
                return this.$store.getters.articleById(id);
            },
            getAllPalletLabels(){
                this.$store.dispatch("getAllPalletLabels");
            },
            getAllArticles(){
                this.$store.dispatch("getAllArticles");
            },

            palletLabelDelete(id, index){
                this.$swal({
                    title: "Are you sure ?",
                    text: "Deleting a PalletLabel, permanently removes it from the application!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f2ab59",
                    confirmButtonText: "Yes, delete PalletLabel!",
                    cancelButtonText: "No, cancel!",
                }).then((confirmed) => {
                    if (confirmed.value) {
                        this.$swal(
                            'Deleted!',
                            'PalletLabel has been deleted.',
                            'success'
                        );
                        this.$store.dispatch("deletePalletLabel", id)
                            .then(() =>{
                                // this.paginate.data.splice(index, 1)
                                // console.log(this.palletLabelsPaginated);
                                this.palletLabelsPaginated.splice(index, 1);
                                // console.log('hoi')
                            })
                    } else {
                        this.$swal("Cancelled", "PalletLabel has not been deleted !", "error");
                    }
                });
            },

        }
    }
</script>


