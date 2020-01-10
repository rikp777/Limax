<template>
    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th class="text-left">#</th>
                <th>Transport</th>
                <th>Created</th>
                <th class="text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
            <template v-if="!shippingLabels">
                <tr>
                    <td colspan="4" class="text-center">No shipping labels Available</td>
                </tr>
            </template>
            <template v-else v-for="shipLabels in shippingLabels">
<!--                <div v-for="shipLabels in shippingLabels">-->
                    <tr v-for="shippingLabel in shipLabels" :key="shippingLabel.id" v-if="articles.length">
<!--                        {{shippingLabel.shippinglabelId}}-->
                        <td> {{ shippingLabel.shippinglabelId.id}}</td>
                        <td> {{ shippingLabel.shippinglabelId.transportDate }}</td>
                        <td> {{ shippingLabel.shippinglabelId.createdAt }}</td>
                        <td class="td-actions text-right">
                            <!--                        <router-link class="btn btn-primary text-white" :to="{ name: 'palletLabelUpdate', params: { id: palletlabel.id }}">Update</router-link>-->
                            <router-link class="btn btn-primary text-white" :to="{ name: 'shippingLabelPdf', params: { id: shippingLabel.shippinglabelId.id }}">PDF</router-link>
                        </td>
                    </tr>
<!--                </div>-->

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
            shippingLabels(){
                return this.$store.getters.shippingLabels
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
            this.getAllShippingLabels();
            this.getAllArticles();
        },
        methods: {
            getArticlesById(id){
                return this.$store.getters.articleById(id);
            },
            getAllShippingLabels(){
                this.$store.dispatch("getAllShippingLabels");
            },
            getAllArticles(){
                this.$store.dispatch("getAllArticles");
            }
        }
    }
</script>


