<template>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Name</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="!palletLabels">
                <tr>
                    <td colspan="4" class="text-center">No pallet labels Available</td>
                </tr>
            </template>
            <template v-else>
                <tr v-for="palletlabel in palletLabels" :key="palletlabel.id" v-if="articles.length">
                    <td> {{ palletlabel.id}}</td>
                    <td> {{ getArticlesById(palletlabel.articleId).name }}</td>
                    <td class="td-actions text-right">
                        <router-link class="btn btn-primary" :to="{ name: 'palletLabelUpdate', params: { id: palletlabel.id }}">Update</router-link>
                        <router-link class="btn btn-primary" :to="{ name: 'palletLabelPdf', params: { id: palletlabel.id }}">PDF</router-link>
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
        computed: {
            palletLabels(){
                return this.$store.getters.palletLabels
            },
            isLoading(){
                return this.$store.getters.palletLabelIsLoading
            },
            articles(){
                return this.$store.getters.articles
            }

        },
        mounted() {
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
            }
        }
    }
</script>


