<template>

    <!--Delivery date, trucker, license-->

    <div class="card-body">
        <form @submit.prevent="validateBeforeSubmit">
            <div class="row">
                <div class="col-6">
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
                    >
                        <!--                                @change="selectTrucker(form.truckerId)"-->
                        <option disabled value="">Select</option>
                        <option v-for="truckDriver in trucks" v-bind:value="truckDriver.id">
                            {{truckDriver.trucker.firstName + " " + truckDriver.trucker.lastName}}
                        </option>
                        <!--                        <option v-for="truckDriver in trucks" v-bind:value="truckDriver.id">{{truckDriver.trucker}}</option>-->
                    </select>
                    <span class="invalid-feedback">{{ errors.first('truckDriver') }}</span>
                </div>
                <div class="col" v-if="form.truckerId">
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
                    >
                        <!--                    @change="selectLicense(form.licenseId)"-->

                        <option disabled value="">Select</option>
                        <option v-for="license in trucks" v-if="license.id === form.truckerId"
                                v-bind:value="license.id">{{license.licensePlate}}
                        </option>
                    </select>
                    <span class="invalid-feedback">{{ errors.first('license') }}</span>
                </div>
            </div>
            <hr v-if="form.licenseId">
            <div class="row" v-if="form.licenseId">
                <div class="col">
                    <label for="deliveryDate">Delivery Date</label>
                    <flat-pickr
                        v-model="form.deliveryDate"
                        name="deliveryDate"
                        id="deliveryDate"
                        v-validate="'required'"
                        :class="{ 'is-invalid': errors.has('deliveryDate') }"
                        class="form-control"
                    />

                    <span class="invalid-feedback">{{ errors.first('deliveryDate') }}</span>
                </div>
            </div>

            <!--            </div>-->
            <hr v-if="form.deliveryDate">
            <div class="row">
                <table class="table" v-if="form.deliveryDate">
                    <thead>
                    <tr style="font-size: x-large">
                        <th>ID</th>
                        <th>Crop Date</th>
                        <th>Amount</th>
                        <th>Article</th>
<!--                        <th>Selected : {{form.palletLabels.length}} <input type="checkbox" v-model="selectAll"></th>-->
                        <th style="text-align: right"><label class="switch"><input type="checkbox" v-model="selectAll"><span class="slider round"></span></label></th>
                    </tr>
                    </thead>
                                        <tbody>

<!--                                        <tr v-for="palletLabel in palletLabels" v-if="articles.length">-->
<!--                                            <td v-if="palletLabel.cropDate === form.deliveryDate">{{palletLabel.id}}</td>-->
<!--                                            <td v-if="palletLabel.cropDate === form.deliveryDate">{{palletLabel.cropDate}}</td>-->
<!--                                            <td v-if="palletLabel.cropDate === form.deliveryDate">{{palletLabel.articleAmount}}</td>-->
<!--                                            <td v-if="palletLabel.cropDate === form.deliveryDate">{{getArticleById(palletLabel.articleId).name}}</td>-->
<!--                                            <td v-if="palletLabel.cropDate === form.deliveryDate" style="text-align: center">-->
<!--                                                <label class="form-checkbox">-->
<!--                                                    <input type="checkbox" :value="palletLabel.id" v-model="form.palletLabels"-->
<!--                                                            style="display: none;">-->
<!--                                                    <palletlabelSelectStyling class="noselect btn btn-secondary"><b>➤</b>-->
<!--                                                    </palletlabelSelectStyling>-->

<!--                                                </label>-->
<!--                                            </td>-->
<!--                                        </tr>-->
                                        <tr v-for="palletLabel in palletLabels" v-if="articles.length">
                                            <td>{{palletLabel.id}}</td>
                                            <td>{{palletLabel.cropDate}}</td>
                                            <td>{{palletLabel.articleAmount}}</td>
                                            <td>{{getArticleById(palletLabel.articleId).name}}</td>
                                            <td style="text-align: right">
                                                <label class="switch">
                                                    <input type="checkbox" :value="palletLabel.id" v-model="form.palletLabels"
                                                           style="display: none;" number>
                                                    <span class="slider round"></span>

                                                </label>
                                            </td>
                                        </tr>
                                        </tbody>

                </table>
            </div>
            <div class="row" v-if="form.palletLabels.length >= 1">
                <!--                <router-link :to="{ name: 'shippingLabelPdf', params: { id: selected }}" :v-slot="{ href}">-->
                <!--                    <button type="submit" :href="href" class="btn btn-primary text-white">Print</button>-->
                <!--                </router-link>-->
                <!--                <button type="submit" class="btn btn-primary text-white">Print</button>-->
                <!--                <button type="button" class="btn btn-primary text-white" @click="$router.push({name: 'shippingLabelPdf', params: { id: shippingLabelID.data[0].id+1 },})">Print</button>-->
                <!--                {{shippingLabelID.data[0].id}}-->
                <hr>
                <button type="button" class="btn btn-primary text-white" @click="validateBeforeSubmit">Print</button>
                <!--                 <router-link tag="button" type="button" class="btn btn-primary text-white" exact v-on:click.native="validateBeforeSubmit()" >Print</router-link>-->
            </div>
        </form>

    </div>


</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    //import FlatPickr from "vue-flatpickr-component/src/component";
    import $router from "vue-router/dist/vue-router.esm.browser";
    import shippingLabel from "../../router/routes/shippingLabel";
    import palletLabel from "../../router/routes/palletLabel";

    export default {
        name: "shippingLabel-update",
        //components: {FlatPickr},
        updated() {
            $(this.$refs.selectTrucker).selectpicker('refresh');
            $(this.$refs.selectLicense).selectpicker('refresh');
        },
        data() {
            return {
                selectedColor: '',
                form: {
                    // shippingLblid: '',
                    palletLabels: [],
                    deliveryDate: '',
                    truckerId: '',
                    licenseId: ''
                },
                serverErrors: '',
                updateMode: false,
                selected: []
            }
        },
        computed: {
            palletLabels() {
                return this.$store.getters.palletLabels
            },
            // shippingLabelID() {
            //     // console.log('sadfasdfasd' + this.$store.getters.shippingLabels);
            //     return this.$store.getters.shippingLabels
            // },
            shippingLabel() {
                return this.$store.getters.shippingLabel
            },
            shippingLabelID() {
                return this.$store.getters.shippingLabelID
            },
            articles() {
                return this.$store.getters.articles
            },
            trucks() {
                // console.log(this.$store.getters.trucks);
                return this.$store.getters.trucks
            },
            selectAll: {
                get() {
                    if (this.form.palletLabels && this.form.palletLabels.length > 0) { // A users array exists with at least one item
                        let allChecked = true;

                        this.form.palletLabels.forEach((label) => {
                            if (!this.selected.includes(label.id)) {
                                allChecked = false; // If even one is not included in array
                            }

                            // Break out of loop if mismatch already found
                            if(!allChecked) return;
                        });

                        return allChecked;
                    }

                    return false;
                },
                set(value) {
                    const checked = [];

                    if (value) {
                        this.palletLabels.forEach((label) => {
                            checked.push(label.id);
                        });
                    }

                    this.form.palletLabels = checked;
                }
            },
        },
        mounted() {
            this.getAllPalletLabels();
            this.getAllArticles();
            this.getAllTrucks();
            this.getAllShippingLabels();
        },

        methods: {
            isLoading() {
                return false;
            },
            // clickList: function (palletLabel, index) {
            //     console.log(index);
            //     console.log(palletLabel.id);
            //     if(this.form.palletLabels[index]){
            //        // delete this.form.palletLabels[index];
            //         this.form.palletLabels.slice(index, index)
            //     }else {
            //         this.form.palletLabels[index] = palletLabel.id;
            //     }
            // },
            createShippingLabel() {
                this.$store.dispatch("createShippingLabel", this.form)
            },
            updateShippingLabel() {
                // console.log(this.form);
                this.$store.dispatch("updateShippingLabel", this.form)
            },
            updatePalletLabelStatus() {
                // console.log(this.form);
                this.$store.dispatch("updatePalletLabelStatus", this.form.palletLabels)
            },
            createShippingPalletID() {
                this.$store.dispatch("createShippingPalletID", this.form)
            },
            getArticleById(id) {
                return this.$store.getters.articleById(id)
            },
            getAllPalletLabels() {
                this.$store.dispatch("getAllPalletLabels");
            },
            getAllShippingLabels() {
                this.$store.dispatch("getAllShippingLabels").then(()=>{
                    // this.form.palletLabels = this.palletLabels;
                });
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            getAllTrucks() {
                this.$store.dispatch("getAllTrucks");
            },
            validateBeforeSubmit() {

                this.$validator.validateAll().then((result) => {
                    // console.log(result);
                    if (result) {
                        if (this.updateMode) {
                            // this.updateShippingLabel();
                            this.$store.dispatch("updateShippingLabel", this.form)
                                .then(() => {
                                    // console.log(this.palletLabel.id);
                                    this.$router.push({name: 'shippingLabelPdf', params: {id: this.shippingLabel.id}})
                                });
                        } else {
                            // this.createShippingLabel();
                            this.updatePalletLabelStatus();
                            this.$store.dispatch("createShippingLabel", this.form)
                                .then(() => {
                                        this.$router.push({
                                            name: 'shippingLabelPdf',
                                            params: {id: this.shippingLabel.id}
                                        })
                                });



                            // const routerConst = this.$router;
                            // const idConst = this.shippingLabelID.data[0].shippinglabelId.id + 1;
                            // // console.log(idConst);
                            // setTimeout(function () {
                            //     // tom.push({ path: `shippingLabel/pdf/${shippingLabelidTest}` });
                            //     routerConst.push({name: 'shippingLabelPdf', params: {id: idConst}})
                            // }, 400);
                        }
                    }
                })
            }
            ,
        }
    }
</script>
<style>
    .noselect {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none;
        /* Non-prefixed version, currently
                                         supported by Chrome, Opera and Firefox */
    }

    input[type=checkbox] + palletlabelSelectStyling {
        /*color: #ccc;*/
        /*font-style: italic;*/
    }

    input[type=checkbox]:checked + palletlabelSelectStyling {
        color: white;
        font-weight: bold;
        font-style: normal;
        background-color: #f2ab59;
        border-color: #f2ab59;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #f2ab59;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #f2ab59;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
