<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item" v-for="(farmer, index) in farmers">
                                    <button type="button" class="btn btn-primary btn-lg nav-link" @click="getOverzicht(farmer.id)">{{farmer.name}}</button>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="card-body">
                        <hr v-if="planning.labels">
                        <div class="row" v-if="planning.labels">
                            <h5>Label Overview</h5>
                        </div>
                        <div class="row">
                            <table class="table" v-if="planning.labels">
                                <thead>
                                <tr>
                                    <th scope="col">Farmer</th>
                                    <th scope="col">PalletNr</th>
                                    <th scope="col">Crop Date</th>
                                    <th scope="col">Article</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="plannings in planning.labels">
                                    <!--                    <td>{{plannings}}</td>-->
                                    <td>{{getFarmerById(plannings.farmerId).name}}</td>
                                    <td>{{plannings.id}}</td>
                                    <td>{{plannings.cropDate}}</td>
                                    <td>{{getArticlesById(plannings.articleId).name}}</td>
                                    <td>{{plannings.articleAmount}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr v-if="planning.labels">
                        <div class="row" v-if="planning.groupedarticles">
                            <h5>Statistics</h5>
                        </div>
                        <div class="row" v-if="planning.groupedarticles">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Amount of Labels</th>
                                        <th>{{planning.totalpallets}}</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Article</th>
                                        <th scope="col">Total Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(value, id) in planning.groupedarticles">
                                        <td>
                                            {{getArticlesById(parseInt(id)).name}}
                                        </td>
                                        <td>
                                            {{value}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--    <div>-->
<!--        <div class="row">-->
<!--            <button v-for="(farmer, index) in farmers" type="button" class="btn btn-primary text-white" @click="getOverzicht(farmer.id)">{{farmer.name}}</button>-->
<!--        </div>-->
<!--        <hr v-if="planning.labels">-->
<!--        <div class="row" v-if="planning.labels">-->
<!--            <h5>Label Overview</h5>-->
<!--        </div>-->
<!--        <div class="row">-->
<!--            <table class="table" v-if="planning.labels">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th scope="col">Farmer</th>-->
<!--                    <th scope="col">PalletNr</th>-->
<!--                    <th scope="col">Crop Date</th>-->
<!--                    <th scope="col">Article</th>-->
<!--                    <th scope="col">Amount</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                <tr v-for="plannings in planning.labels">-->
<!--                    &lt;!&ndash;                    <td>{{plannings}}</td>&ndash;&gt;-->
<!--                    <td>{{getFarmerById(plannings.farmerId).name}}</td>-->
<!--                    <td>{{plannings.id}}</td>-->
<!--                    <td>{{plannings.cropDate}}</td>-->
<!--                    <td>{{getArticlesById(plannings.articleId).name}}</td>-->
<!--                    <td>{{plannings.articleAmount}}</td>-->
<!--                </tr>-->
<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->
<!--        <hr v-if="planning.labels">-->
<!--        <div class="row" v-if="planning.groupedarticles">-->
<!--            <h5>Statistics</h5>-->
<!--        </div>-->
<!--        <div class="row" v-if="planning.groupedarticles">-->
<!--            <div class="col">-->
<!--                <table class="table">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>Amount of Labels</th>-->
<!--                        <th>{{planning.totalpallets}}</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                </table>-->
<!--            </div>-->
<!--            <div class="col">-->
<!--                <table class="table">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th scope="col">Article</th>-->
<!--                        <th scope="col">Total Amount</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    <tr v-for="(value, id) in planning.groupedarticles">-->
<!--                        <td>-->
<!--                            {{getArticlesById(parseInt(id)).name}}-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            {{value}}-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        name: "planningRead",
        data() {
            return {
                farmerId: 0
            }
        },
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
            getFarmerById(id) {
                return this.$store.getters.farmerById(id);
            },
            getOverzicht(id){
                this.$store.dispatch("getPlanning", id)
                    .then(() => {
                        // console.log('hoi');
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
