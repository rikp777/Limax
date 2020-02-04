<template>
    <b-row>
        <b-colxx md="12" class="mb-4">
                <b-form @submit.prevent="validateBeforeSubmit">
                    <b-row>
<!--                        //trucker-->
                        <b-colxx xs="12" xl="6">
                            <b-form-group :label="$t('shippinglabel.attributes.trucker.title')">
<!--                                {{trucks}}-->
                                <multiselect
                                    v-model="form.trucker"
                                    v-validate="'required'"
                                    data-vv-validate-on="change|custom"
                                    :options="truckers"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :allow-empty="false"
                                    placeholder="Pick some"
                                    label="fullName"
                                    track-by="fullName"
                                    name="fullName"
                                    :class="errors.first('trucker') ? 'input-error' : ''"
                                >
                                    <template
                                        slot="selection"
                                        slot-scope="{ values, search, isOpen }">
                                    <span
                                        class="multiselect__single"
                                        v-if="values.length &amp;&amp; !isOpen">
                                      {{ values.length }} options selected
                                    </span>
                                    </template>
                                </multiselect>
                            </b-form-group>

                        </b-colxx>
<!--                        //truck-->
                        <b-colxx xs="12" xl="6">
                            <b-form-group :label="$t('shippinglabel.attributes.trucks.title')">
                                <!--                                {{trucks}}-->
                                <multiselect
                                    v-model="form.truck"
                                    v-validate="'required'"
                                    data-vv-validate-on="change|custom"
                                    :options="trucks"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :allow-empty="false"
                                    placeholder="Pick some"
                                    label="licensePlate"
                                    track-by="licensePlate"
                                    name="licensePlate"
                                    :class="errors.first('truck') ? 'input-error' : ''"
                                >
                                    <template
                                        slot="selection"
                                        slot-scope="{ values, search, isOpen }">
                                    <span
                                        class="multiselect__single"
                                        v-if="values.length &amp;&amp; !isOpen">
                                      {{ values.length }} options selected
                                    </span>
                                    </template>
                                </multiselect>
                            </b-form-group>

                        </b-colxx>
<!--                        //date-->
<!--                        //palletlabelSelect-->

                    </b-row>
                </b-form>
        </b-colxx>
    </b-row>
</template>

<script>
    export default {
        // TODO
        // Hier kan een vrachtbrief aangemaakt worden
        // trucker(user) kan meerdere vrachtwagens hebben
        name: "ShippinglabelCreate.vue",
        updated() {
            $(this.$refs.selectTrucker).selectpicker('refresh');
            $(this.$refs.selectLicense).selectpicker('refresh');
        },
        data() {
            return {
                selectedColor: '',
                form: {
                    palletLabels: [],
                    deliveryDate: '',
                    trucker: [],
                    truck: [],
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
            truckers() {
                // console.log(this.$store.getters.truckers);
                return this.$store.getters.truckers
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
                            if (!allChecked) return;
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
            this.getAllTruckers();
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
                this.$store.dispatch("getAllShippingLabels").then(() => {
                    // this.form.palletLabels = this.palletLabels;
                });
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            getAllTrucks() {
                this.$store.dispatch("getAllTrucks");
            },
            getAllTruckers() {
                this.$store.dispatch("getAllTruckers");
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

