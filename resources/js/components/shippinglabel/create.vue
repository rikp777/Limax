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
                            <option v-for="trucker in truckers" v-bind:value="trucker.id">{{trucker.name}}</option>
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
                            <option v-for="license in licenses" v-bind:value="license.id">{{license.name}}</option>
                        </select>
                        <span class="invalid-feedback">{{ errors.first('license') }}</span>
                    </div>
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
            truckers(){
                //console.log(this.$store.getters.truckers);
                return this.$store.getters.truckers;
            },
            licenses(){
                //console.log(this.$store.getters.licenses);
                return this.$store.getters.licenses;
            },
        },
        mounted(){
            console.log(this.$store);
            this.getAllTruckers();
            this.getAllLicenses();
        },
        methods: {
            getAllTruckers(){
                this.$store.dispatch("getAllTruckers");
            },
            getAllLicenses(){
                this.$store.dispatch("getAllLicenses");
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.create();
                    }
                })
            },
            selectTrucker(id) {

            },
            selectLicense(id) {

            }
        }
    }
</script>
