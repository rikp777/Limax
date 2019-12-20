<template>
    <div>
        <router-link :to="{ name: 'shippingLabelCombine' }" class="btn btn-light btn-block"
                     style="position: relative; z-index: 3">New
        </router-link>

        <template>
            <div class="card-body" v-on:click="checkPrint" id="printMe">
                <div style="
                    background: url('https://www.limax.nl/build/images/color-block.ac4809e9.svg') right bottom fixed;
                    background-size: cover;
                    display: block;
                    height: 100%;
                    width: 100%;
                    position: absolute;
                    top: 0;
                    left: 0;
                    z-index: 1;
                    filter: grayscale(99%);
                    opacity: 0.1;
                "></div>
                <div style="
                    display: block;
                    height: 100%;
                    width: 100%;
                    position: relative;
                    left: 0px;
                    top: 0px;
                    z-index: 2;
                ">
                    <div class="text-center" style="z-index: 10;">
                        <!--                    <img class="card-img-top" style="width: 400px; height: auto; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">-->
                        <img class="card-img-top" style="width: 400px; height: auto; margin-bottom: 10px"
                             src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <!--                STATUS-->
                    <div class="row">
                        <div class="col-sm-6" style="font-size: 16px;">
                            <strong>Shippinglabel: </strong>{{ moment().format("dddd, MMMM Do YYYY") }}
                        </div>
                        <div class="col-sm-6" style="font-size: 16px;">
                            <span class="float-right"> <strong>Status: </strong>Ready </span>
                        </div>
                    </div>
                    <hr>
                    <!--                FROM / TO-->
                    <div class="row">
                        <template>
                            <div class="col-sm-6" style="font-size: 16px;">
                                <h6 class="mb-3" style="font-size: 22px;">Import :</h6>
                                <!--                                <strong>{{ Import }}</strong>-->
                                <div>Time: {{ moment().locale('nl').format('LTS') }}</div>
                                <div>Date: {{ moment().locale('nl').format('L') }}</div>
                            </div>
                        </template>
                        <template>
                            <div class="col-sm-6" style="font-size: 16px;">
                                <h6 class="mb-3" style="font-size: 22px;">Transport :</h6>
                                <!--                                <strong>Transport</strong>-->
                                <div>Time: {{ moment().locale('nl').format('LTS') }}</div>
                                <div>Date: {{ moment().locale('nl').format('L') }}</div>
                            </div>
                        </template>
                    </div>
                    <hr>

                    <div class="row">
                        <template>
                            <div class="col-sm-6" style="font-size: 22px;">
                                <h6 class="mb-3" style="font-size: 26px;">FROM :</h6>
                                <div>
                                    <strong>{{ farmer.name }}</strong>
                                    <div>{{ farmer.street }}, {{ farmer.houseNumber }}</div>
                                    <div>{{ farmer.place }}, {{ farmer.zipCode }}</div>
                                    <div>Email: {{ farmer.email }}</div>
                                    <div>Phone: {{ farmer.phone }}</div>
                                    <br>

                                    <strong>Certificates</strong>
                                    <div v-for="certificate in farmer.certificates">
                                        {{certificate.certificate.name}}: {{certificate.code}}
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template>
                            <div class="col-sm-6" style="font-size: 22px;">
                                <h6 class="mb-3" style="font-size: 26px;">Truck Driver :</h6>
                                    <strong>{{truckDriver.trucker.firstName + " " + truckDriver.trucker.lastName}}</strong>
                                    <div>License: {{truckDriver.licensePlate}}</div>
                            </div>
                        </template>
                    </div>
                    <hr>

                    <template>


                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <h6 class="mb-3" style="font-size: 26px;">Total</h6>
                            </div>

                            <div class="col-sm-6">
                                <h6 class="mb-3" style="font-size: 26px;">Detail</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6" style="font-size: 22px;">
                                <table style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            Article:
                                        </th>
                                        <th>
                                            Amount:
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="total in ShippingLabelPalletLabels['total']" v-if="articles.length">
                                        <td>
                                            {{ getArticlesById(total.articleId).name }}
                                        </td>
                                        <td>
                                            {{ total.amount }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6" style="font-size: 22px;">
                                <table style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>
                                            Nr.:
                                        </th>
                                        <th>
                                            Article:
                                        </th>
                                        <th>
                                            Amount:
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="detail in ShippingLabelPalletLabels['detail']" v-if="articles.length">
                                        <td>
                                            {{ detail.palletlabelId }}
                                        </td>
                                        <td>
                                            {{ getArticlesById(detail.articleId).name }}
                                        </td>
                                        <td>
                                            {{ detail.amount }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="barcodee" style="font-family: 'Libre Barcode 39', cursive;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="text-center">
                                <!--                            <img class="card-img-bottom" style=" bottom:0; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/build/images/color-bar.48031fde.svg' alt="Card image cap">-->
                                <img class="card-img-bottom" style=" bottom:0;"
                                     src='https://www.limax.nl/build/images/color-bar.48031fde.svg'
                                     alt="Card image cap">
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <div class="card-body" style="page-break-after: always;">
            </div>
        </template>
    </div>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import palletLabel from "../../router/routes/palletLabel";
    import $router from "vue-router/dist/vue-router.esm.browser";
    import {getToken} from '../../common/jwt.service';

    export default {
        name: 'shippingLabel-pdf',
        computed: {
            ...mapGetters(["authUser"]),
            articles() {
                return this.$store.getters.articles
            },
            article() {
                return this.$store.getters.article;
            },
            palletLabel() {
                return this.$store.getters.palletLabel;
            },
            ShippingLabelPalletLabels() {
                return this.$store.getters.shippingLabel;
            },
            farmer() {
                return this.$store.getters.farmer;
            },
            truckDriver() {
                return this.$store.getters.truck;
            },
            isLoading() {
                return this.$store.getters.farmerIsLoading;
            }
        },
        methods: {
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            },
            getTruck(id) {
                this.$store.dispatch("getTruck", id);
            },
            getArticlesById(id) {
                return this.$store.getters.articleById(id);
            },
            getArticle(id) {
                this.$store.dispatch("getArticle", id);
            },
            getShippingLabelPalletLabels(id) {
                // console.log('getShippingLabelPalletLabels id = ' + id);
                this.$store.dispatch("getShippingLabel", id)
            },
            getShippingLabel(id){
              // this.$store.dispatch("")
            },
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            },
            checkPrint() {
                this.$htmlToPaper('printMe');
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
        },
        mounted() {
            this.getFarmer(getToken('farmer'));
            this.getTruck(2);
            Promise.all([
                // console.log('hoi' + this.$route.params.id),
                // this.getFarmer(),
                this.getAllArticles(),
                this.getShippingLabelPalletLabels(this.$route.params.id)
            ]).finally(() => {
                console.log(" nu ben ik klaar");
                // this.checkPrint();
            });
        },

    }
</script>
<style scoped>

    .barcodee {
    @import url('https://fonts.googleapis.com/css?family=Libre+Barcode+39&display=swap');
        font-family: 'Libre Barcode 39', cursive;
        font-size: 100%;
    }

</style>

