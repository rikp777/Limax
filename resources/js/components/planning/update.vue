<template>
    <div>
        <div class="row">
            <button v-for="(farmer, index) in farmers" type="button" class="btn btn-primary text-white" @click="getOverzicht(farmer.id)">{{farmer.name}}</button>
        </div>
        <hr>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Article</th>
                    <th scope="col">Crop Date</th>
                    <th scope="col">Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="plannings in planning">
                    <th scope="row">{{plannings.id}}</th>
                    <td>{{getArticlesById(plannings.articleId).name}}</td>
                    <td>{{plannings.cropDate}}</td>
                    <td>{{plannings.articleAmount}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        name: "planning-update",
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"]),
            farmers() {
                return this.$store.getters.farmers;
            },
            planning() {
                return this.$store.getters.planning;
            },
        },
        mounted(){
            this.getAllFarmers();
            this.getAllPlannings();
            this.getAllArticles();
        },
        methods: {
            getAllFarmers() {
                this.$store.dispatch("getAllFarmers");
            },
            getAllPlannings() {
                this.$store.dispatch("getAllPlannings");
            },
            getArticlesById(id) {
                return this.$store.getters.articleById(id);
            },
            getOverzicht(id){
                this.$store.dispatch("getPlanning", id)
                    .then(() => {
                        console.log('hoi');
                        // this.form = this.palletLabel;
                    });
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
        }
    }
</script>

<style scoped>

</style>
