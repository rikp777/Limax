<template>
    <b-row>
        <b-colxx md="12" class="mb-4">
            <b-card title="alerts">
                <b-refresh-button @click="refreshButtonClick" />
                <vue-perfect-scrollbar class="scroll dashboard-list-with-user" :settings="{ suppressScrollX: true, wheelPropagation: false }">
                    <list-with-palletlabel-setup-item v-for="(item, index) in setupItems" :data="item" :key="index" />
                </vue-perfect-scrollbar>
            </b-card>
        </b-colxx>
        <b-colxx md="12" class="mb-4">
            <b-card title="Palletlabel Create" :class="{ 'updatemodeStyle': updateMode }">
            </b-card>
        </b-colxx>

    </b-row>


</template>

<script>
    import ListWithPalletlabelSetupItem from "../../listing/ListWithPalletlabelSetupItem";
    import {mapActions, mapGetters} from "vuex";
    export default {
        name: "Create.vue",
        components: {ListWithPalletlabelSetupItem},
        data() {
            return {
                setupItems: []
            }
        },
        methods: {
            ...mapActions([
                'getAllFarmerArticles',
                'getAllCells',
                'getAllPalletlabels',
                'getAllPalletTypes'
            ]),
            checkSetup(){
                if(this.articlesFromFarmer.length){
                    let data = {
                        title: 'test',
                        description: 'test'
                    };
                    this.setupItems.push(data);
                }
            }
        },
        computed: {
            ...mapGetters({
                articlesFromFarmer: 'articlesFromFarmer',
            })
        },
        mounted() {
            this.getAllFarmerArticles();
            this.checkSetup()
        }
    }
</script>

<style scoped>

</style>
