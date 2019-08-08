<template>
    <div>
        <template v-if="isLoading">
            <div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </template>
        <template v-else>
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
                        <img class="card-img-top" style="width: 400px; height: auto; margin-bottom: 10px" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
                    </div>

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

                                <strong>{{ farmer.name }}</strong>
                                <div>{{ farmer.street }}, {{ farmer.house_number }}</div>
                                <div>{{ farmer.place }}, {{ farmer.zip_code }}</div>
                                <div>Email: {{ farmer.email }}</div>
                                <div>Phone: {{ farmer.phone }}</div>


                                <strong>Certificates</strong>
                                <div v-for="certificate in farmer.certificates">
                                    {{certificate.certificate.name}}: {{certificate.code}}
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
                                <h6 class="mb-3" style="font-size: 26px;">LABEL ID : {{ palletLabel.id }}</h6>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Crop Date</strong>
                                <div>{{ palletLabel.crop_date }}</div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Amount</strong>
                                <div>{{ palletLabel.article_amount }}</div>
                            </div>
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Article</strong>
                                <div>{{ article.name }}</div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Origin</strong>
                                <div>{{ article.origin }}</div>
                            </div>
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Weight</strong>
                                <div>{{ article.weight }} GR</div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Harvest Cycle</strong>
                                <div>{{ palletLabel.harvest_cycle }}</div>
                            </div>
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Harvest Cycle Day</strong>
                                <div>{{ palletLabel.harvest_cycle_day }}</div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6" style="font-size: 22px;">
                                <strong>Note</strong>
                                <div>{{ palletLabel.note }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col" >
                                <barcode v-bind:value="palletLabel.id" width="5" lineColor="#F2AB58" background="none" id="text-mask-1"></barcode>
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
            <div class="card-body" style="page-break-after: always;" >
            </div>
        </template>
    </div>

</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import barcode from "vue-barcode";
    export default {
        name: 'palletLabel-pdf',
        components: {barcode},
        computed: {
            article(){
                return this.$store.getters.article;
            },
            palletLabel(){
                return this.$store.getters.palletLabel;
            },
            farmer(){
                return this.$store.getters.farmer;
            },
            isLoading(){
                return this.$store.getters.farmerIsLoading
            }
        },
        methods: {
            getArticle(id){
                this.$store.dispatch("getArticle", id);
            },
            getPalletlabel(id){
                console.log(id);
                this.$store.dispatch("getPalletLabel", id)
                    .then(() => {
                        this.getArticle(this.palletLabel.article_id);
                        this.getFarmer(this.palletLabel.farmer_id);
                        this.$htmlToPaper('printMe');
                    })
            },
            getFarmer(id){
                this.$store.dispatch("getFarmer", id);
            },
            checkPrint() {
                this.$htmlToPaper('printMe');
            },
        },
        mounted() {
            this.getPalletlabel(this.$route.params.id)
        },

    }
</script>
