<template>
    <div>
        <router-link :to="{ name: 'palletLabelCombine' }"  class="btn btn-light btn-block" style="position: relative; z-index: 3">New</router-link>

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
                    <div class="label1" style="page-break-after: always;">
                        <div class="text-center" style="z-index: 10;">
                            <!--                    <img class="card-img-top" style="width: 400px; height: auto; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">-->
                            <img class="card-img-top" style="width: 400px; height: auto; margin-bottom: 10px" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <!--                STATUS-->
                        <div class="row">
                            <div class="col-sm-6" style="font-size: 16px;">
                                <strong>Palletlabel: </strong>{{ moment().format("dddd, MMMM Do YYYY") }}
                            </div>
                            <div class="col-sm-6" style="font-size: 16px;">
                                <span class="float-right"> <strong>Status: </strong>Ready </span>
                            </div>
                        </div>
                        <hr>



                        <!--                FROM / TO-->
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
                                    <h6 class="mb-3" style="font-size: 26px;">TO :</h6>
                                    <strong>Limax Horst</strong>
                                    <div>Venrayseweg, 126b</div>
                                    <div>Horst, 5961 AJ</div>
                                    <div>Email: info@limax.nl</div>
                                    <div>Phone: 773999660</div>
                                </div>
                            </template>
                        </div>
                        <hr>
                        <template>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-3" style="font-size: 26px;">PRODUCT : </h6>
                                </div>

                                <div class="col-sm-6">
                                    <h6 class="mb-3" style="font-size: 26px;">LABEL ID : {{ palletLabel.palletLabelFarmerId }}</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Article</strong>
                                    <div>{{ getArticlesById(palletLabel.articleId).name }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Amount</strong>
                                    <div>{{ palletLabel.articleAmount }}</div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Crop Date</strong>
                                    <div>{{ palletLabel.cropDate }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Weight</strong>
                                    <div>{{ getArticlesById(palletLabel.articleId).weight }} GR</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Harvest Cycle</strong>
                                    <div>{{ palletLabel.harvestCycle }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Harvest Cycle Day</strong>
                                    <div>{{ palletLabel.harvestCycleDay }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Origin</strong>
                                    <div>{{ getArticlesById(palletLabel.articleId).origin }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Note</strong>
                                    <div>{{ palletLabel.note }}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="barcodee" style="font-family: 'Libre Barcode 39', cursive;">{{palletLabel.pallet_label_farmer_id}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <!--                            <img class="card-img-bottom" style=" bottom:0; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/build/images/color-bar.48031fde.svg' alt="Card image cap">-->
                                    <img class="card-img-bottom" style=" bottom:0;" src='https://www.limax.nl/build/images/color-bar.48031fde.svg' alt="Card image cap">
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="label2" style="page-break-after: always;">
                        <div class="text-center" style="z-index: 10;">
                            <!--                    <img class="card-img-top" style="width: 400px; height: auto; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">-->
                            <img class="card-img-top" style="width: 400px; height: auto; margin-bottom: 10px" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <!--                STATUS-->
                        <div class="row">
                            <div class="col-sm-6" style="font-size: 16px;">
                                <strong>Palletlabel: </strong>{{ moment().format("dddd, MMMM Do YYYY") }}
                            </div>
                            <div class="col-sm-6" style="font-size: 16px;">
                                <span class="float-right"> <strong>Status: </strong>Ready </span>
                            </div>
                        </div>
                        <hr>



                        <!--                FROM / TO-->
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
                                    <h6 class="mb-3" style="font-size: 26px;">TO :</h6>
                                    <strong>Limax Horst</strong>
                                    <div>Venrayseweg, 126b</div>
                                    <div>Horst, 5961 AJ</div>
                                    <div>Email: info@limax.nl</div>
                                    <div>Phone: 773999660</div>
                                </div>
                            </template>
                        </div>
                        <hr>
                        <template>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <h6 class="mb-3" style="font-size: 26px;">PRODUCT : </h6>
                                </div>

                                <div class="col-sm-6">
                                    <h6 class="mb-3" style="font-size: 26px;">LABEL ID : {{ palletLabel.palletLabelFarmerId }}</h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Article</strong>
                                    <div>{{ getArticlesById(palletLabel.articleId).name }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Amount</strong>
                                    <div>{{ palletLabel.articleAmount }}</div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Crop Date</strong>
                                    <div>{{ palletLabel.cropDate }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Weight</strong>
                                    <div>{{ getArticlesById(palletLabel.articleId).weight }} GR</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Harvest Cycle</strong>
                                    <div>{{ palletLabel.harvestCycle }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Harvest Cycle Day</strong>
                                    <div>{{ palletLabel.harvestCycleDay }}</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Origin</strong>
                                    <div>{{ getArticlesById(palletLabel.articleId).origin }}</div>
                                </div>
                                <div class="col-sm-6" style="font-size: 22px;">
                                    <strong>Note</strong>
                                    <div>{{ palletLabel.note }}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="barcodee" style="font-family: 'Libre Barcode 39', cursive;">{{palletLabel.pallet_label_farmer_id}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="text-center">
                                    <!--                            <img class="card-img-bottom" style=" bottom:0; -webkit-filter: grayscale(100%); filter: grayscale(100%);" src='https://www.limax.nl/build/images/color-bar.48031fde.svg' alt="Card image cap">-->
                                    <img class="card-img-bottom" style=" bottom:0;" src='https://www.limax.nl/build/images/color-bar.48031fde.svg' alt="Card image cap">
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
            <div class="card-body" style="page-break-after: always;" >
            </div>
        </template>
    </div>

</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import palletLabel from "../../router/routes/palletLabel";
    import {getToken} from '../../common/jwt.service';

    export default {
        name: 'palletLabel-pdf',
        computed: {
            ...mapGetters(["authUser"]),
            article(){
                return this.$store.getters.articles;
            },
            palletLabel(){
                return this.$store.getters.palletLabel;
            },
            farmer(){
                return this.$store.getters.farmer;
            },
            isLoading(){
                return this.$store.getters.farmerIsLoading;
            }
        },
        methods: {
            getArticlesById(id) {
                return this.$store.getters.articleById(id);
            },
            getArticle(id) {
                this.$store.dispatch("getArticle", id);
            },
            getPalletlabel(id){
                // console.log(id);
                this.$store.dispatch("getPalletLabel", id)
            },
            getFarmer(id){
                this.$store.dispatch("getFarmer", id);
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            checkPrint() {
                this.$htmlToPaper('printMe');
            },
        },
        mounted() {

            Promise.all([
               this.getFarmer(getToken('farmer')),
               this.getPalletlabel(this.$route.params.id),
               this.getAllArticles(),
               // this.getArticle(1)
            ]).finally(() => {
                // console.log(" nu ben ik klaar");
                // this.checkPrint();
            })
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

