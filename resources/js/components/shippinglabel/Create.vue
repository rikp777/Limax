<template>

        <!--Delivery date, trucker, license-->

        <div class="card-body">
            <form @submit.prevent="validateBeforeSubmit">

            </form>
                <div class="row">
                    <div class="col-4">
                        <label for="deliveryDate">Delivery Date</label>
                        <flat-pickr
                                v-model="form.deliveryDate"
                                name="deliveryDate"
                                id="deliveryDate"
                                v-validate="'required'"
                                :class="{ 'is-invalid': errors.has('deliveryDate') }"
                                class="form-control"
                        ></flat-pickr>
                        <span class="invalid-feedback">{{ errors.first('deliveryDate') }}</span>
                    </div>
                    <div class="col-4">
                        <label for="trucker" class="d-block">Trucker</label>
                        <select
                                v-model="form.truckerId"
                                id="trucker"
                                name="trucker"
                                v-validate="'required|numeric'"
                                :class="{ 'is-invalid': errors.has('trucker') }"
                                class="selectpicker"

                                ref="selectTrucker"
                                data-live-search="true"
                                data-width="100%"

                                @change="selectTrucker(form.truckerId)"
                        >
                            <option disabled value="">Select</option>
<!--                            <option v-for="trucker in truckers" v-bind:value="trucker.id">{{trucker.name}}</option>-->
                        </select>
                        <span class="invalid-feedback">{{ errors.first('trucker') }}</span>
                    </div>
                    <div class="col-4">
                        <label for="license" class="d-block">License</label>
                        <select
                                v-model="form.licenseId"
                                id="license"
                                name="license"
                                v-validate="'required|numeric'"
                                :class="{ 'is-invalid': errors.has('license') }"
                                class="selectpicker"

                                ref="selectLicense"
                                data-live-search="true"
                                data-width="100%"

                                @change="selectLicense(form.licenseId)"
                        >
                            <option disabled value="">Select</option>
<!--                            <option v-for="license in licenses" v-bind:value="license.id">{{license.name}}</option>-->
                        </select>
                        <span class="invalid-feedback">{{ errors.first('license') }}</span>
                    </div>
                </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Palletlabels</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="palletLabel in palletLabels" v-if="articles.length">
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="palletlabels" checked>
                                <label class="custom-control-label" for="palletlabels">{{getArticleById(palletLabel.articleId).name}}</label>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import FlatPickr from "vue-flatpickr-component/src/component";

    export default {
        name: "shippingLabel-update",
        components: {FlatPickr},
        updated() {
            $(this.$refs.selectTrucker).selectpicker('refresh');
            $(this.$refs.selectLicense).selectpicker('refresh');
        },
        data() {
            return {
                form: {
                    deliveryDate: '',
                    truckerId: '',
                    licenseId: '',
                },
                serverErrors: '',
            }
        },
        computed: {

            palletLabels(){
                return this.$store.getters.palletLabels
            },
            articles(){
                return this.$store.getters.articles
            },
        },
        mounted(){
            this.getAllPalletLabels();
            this.getAllArticles();
        },
        methods: {
            getArticleById(id){
                // console.log(id);
                return this.$store.getters.articleById(id)
            },
            getAllPalletLabels(){
                this.$store.dispatch("getAllPalletLabels");
            },
            getAllArticles(){
                this.$store.dispatch("getAllArticles");
            },
            getTruckers(){
                this.$store.dispatch("")
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.Create();
                    }
                })
            },
        }
    }
</script>
