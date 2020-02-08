<template>
    <b-row>
        <b-colxx md="12" class="mb-4" v-if="setupItems.length">
            <b-card title="alerts">
                <b-refresh-button/>
                <vue-perfect-scrollbar class="scroll dashboard-list-with-user"
                                       :settings="{ suppressScrollX: true, wheelPropagation: false }">
                    <list-with-palletlabel-setup-item v-for="(item, index) in setupItems" :data="item" :key="index"/>
                </vue-perfect-scrollbar>
            </b-card>
        </b-colxx>
        <!--        <br><hr>-->
        <!--        {{cells}}-->
        <!--        <br><hr>-->
        <!--        {{farmerArticles}}-->
        <!--        <br><hr>-->
        <!--        {{setupItems}}-->
        <!--        <br><hr>-->
        <b-colxx md="12" class="mb-4" v-if="!setupItems.length">

            <b-card :title="$t('palletlabel.update.title') + ' ' + palletLabel.palletLabelFarmerId" style="border-left: 6px solid red">
              <!-- <b-card :title="$t('palletlabel.update.title') + ' ' + id"> -->
                <div class="position-absolute card-top-buttons">
                    <b-badge class="mb-1" pill variant="danger">{{$t('palletlabel.update.modeTitle')}}</b-badge>
                </div>
                <validation-observer ref="observer" v-slot="{ invalid }">
                <b-form @submit.prevent="formSubmit()">
                    <b-row>

                        <!-- Articles  -->
                        <b-colxx xs="12" xl="6">
                          <validation-provider
                             :name="$t('palletlabel.attributes.article.title')"
                             :rules="{ required: true }"
                             v-slot="validationContext"
                           >
                            <b-form-group :label="$t('palletlabel.attributes.article.title')" id="article-group" label-for="article">
                                <multiselect
                                    v-if="farmerArticles"
                                    v-model="form.article"
                                    :options="farmerArticles"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :allow-empty="false"
                                    placeholder="Pick some"
                                    label="name"
                                    track-by="name"
                                    id="article"
                                    name="article"
                                    :state="getValidationState(validationContext)"
                                    aria-describedby="article-live-feedback"
                                    @input="selectPallettype()"
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
                                    <b-form-invalid-feedback id="article-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                                </multiselect>
                                <!-- <b-form-invalid-feedback id="input-1-live-feedback">{{ veeErrors.first('example-input-1') }}</b-form-invalid-feedback> -->
                            </b-form-group>
                          </validation-provider>
                        </b-colxx>


                        <!-- PalletTypes  -->
                        <b-colxx xs="12" xl="6">
                          <validation-provider
                             :name="$t('palletlabel.attributes.palletType.title')"
                             :rules="{ required: true }"
                             v-slot="validationContext"
                           >
                            <b-form-group :label="$t('palletlabel.attributes.palletType.title')" id="palletType-group" label-for="palletType">
                                <multiselect
                                    id="palletType"
                                    name="palletType"
                                    v-if="form.palletType"
                                    v-model="form.palletType"
                                    :options="palletTypes"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :allow-empty="false"
                                    placeholder="Pick some"
                                    label="name"
                                    track-by="name"
                                    :state="getValidationState(validationContext)"
                                    aria-describedby="palletType-live-feedback"
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
                                <b-form-invalid-feedback id="palletType-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                            </validation-provider>

                        </b-colxx>


                        <!-- Crop Date  -->
                        <b-colxx xs="12" xl="6">
                          <validation-provider
                             :name="$t('palletlabel.attributes.cropDate.title')"
                             :rules="{ required: true }"
                             v-slot="validationContext"
                           >
                            <b-form-group :label="$t('palletlabel.attributes.cropDate.title')" id="cropDate-group" label-for="cropDate">
                                <vue-flatpickr-component
                                  v-model="form.cropDate"
                                  class="form-control"
                                  static='true'
                                  id="cropDate"
                                  name="cropDate"
                                  :state="getValidationState(validationContext)"
                                  aria-describedby="cropDate-live-feedback"
                                />
                                <b-form-invalid-feedback id="cropDate-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                            </validation-provider>
                            <!-- {{this.$moment(form.cropDate).format("YYYY-MM-DD")}} -->
                        </b-colxx>


                        <!-- Amount  -->
                        <b-colxx xs="12" xl="6">
                          <validation-provider
                             :name="$t('palletlabel.attributes.amount.title')"
                             :rules="{ required: true }"
                             v-slot="validationContext"
                           >
                            <b-form-group id="amount-group" :label="$t('palletlabel.attributes.amount.title')" label-for="amount">
                                <b-form-input
                                    id="amount"
                                    name="amount"
                                    v-model="form.amount"
                                    :state="getValidationState(validationContext)"
                                    aria-describedby="amount-live-feedback"
                                    type="number"
                                    min="0.00"/>
                                  <b-form-invalid-feedback id="amount-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                            </validation-provider>
                        </b-colxx>


                        <!-- Cell  -->
                        <b-colxx xs="12" xl="4">
                          <validation-provider
                             :name="$t('palletlabel.attributes.cell.title')"
                             :rules="{ required: true }"
                             v-slot="validationContext"
                           >
                            <b-form-group :label="$t('palletlabel.attributes.cell.title')" id="cell-group" label-for="cell">
                                <multiselect
                                    v-if="form.cell"
                                    v-model="form.cell"
                                    id="cell"
                                    name="cell"
                                    :options="cells"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :allow-empty="false"
                                    placeholder="Pick some"
                                    label="description"
                                    track-by="description"
                                    :state="getValidationState(validationContext)"
                                    aria-describedby="cell-live-feedback"
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
                                <b-form-invalid-feedback id="cell-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                            </validation-provider>
                        </b-colxx>


                        <!-- Flight  -->
                        <b-colxx xs="12" xl="4">
                          <validation-provider
                             :name="$t('palletlabel.attributes.harvestCycle.title')"
                             :rules="{ required: true }"
                             v-slot="validationContext"
                           >
                            <b-form-group :label="$t('palletlabel.attributes.harvestCycle.title')" id="harvestCycle-group" label-for="harvestCycle">
                                <b-form-input
                                    id="harvestCycle"
                                    name="harvestCycle"
                                    v-model="form.harvestCycle"
                                    type="number"
                                    :state="getValidationState(validationContext)"
                                    aria-describedby="harvestCycle-live-feedback"
                                    min="0.00"/>
                                    <b-form-invalid-feedback id="amount-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                            </validation-provider>
                        </b-colxx>


                        <!-- Flight Day -->
                        <b-colxx xs="12" xl="4">
                          <validation-provider
                             :name="$t('palletlabel.attributes.harvestCycleDay.title')"
                             :rules="{ required: true }"
                             v-slot="validationContext"
                           >
                            <b-form-group :label="$t('palletlabel.attributes.harvestCycleDay.title')" id="harvestCycleDay-group" label-for="harvestCycleDay">
                                <b-form-input
                                    id="harvestCycleDay"
                                    name="harvestCycleDay"
                                    v-model="form.harvestCycleDay"
                                    :state="getValidationState(validationContext)"
                                    aria-describedby="harvestCycleDay-live-feedback"
                                    type="number"
                                    min="0.00"/>
                                    <b-form-invalid-feedback id="harvestCycleDay-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
                            </b-form-group>
                            </validation-provider>
                        </b-colxx>


                        <!-- Note -->
                        <b-colxx xs="12">
                            <b-form-group :label="$t('palletlabel.attributes.note.title')">
                                <b-form-textarea
                                    v-model="form.note"
                                    id="note"
                                    name="note"
                                    type="text"
                                    class="form-control"
                                />
                            </b-form-group>
                        </b-colxx>


                        <!-- Buttons -->
                        <b-colxx xs="12">
                            <b-form-group :label="$t('palletlabel.create.actions.title')" label-align="right">
                                <div class="d-flex justify-content-end">
                                    <b-button
                                        type="button"
                                        variant="outline-danger"
                                        class="ml-1"
                                        @click="cancel"
                                    >{{ $t('palletlabel.update.actions.buttonCancel') }}
                                    </b-button>
                                    <b-button
                                        type="submit"
                                        :disabled="invalid"
                                        variant="primary"
                                        class="ml-1"
                                    >{{ $t('palletlabel.update.actions.buttonUpdate') }}
                                    </b-button>
                                </div>
                            </b-form-group>

                        </b-colxx>


                    </b-row>


                </b-form>
                 </validation-observer>
            </b-card>
        </b-colxx>

    </b-row>


</template>

<script>
    import ListWithPalletlabelSetupItem from "../../listing/ListWithPalletlabelSetupItem";
    import {mapActions, mapGetters} from "vuex";

    export default {
        name: "Create.vue",
        components: {
            ListWithPalletlabelSetupItem,
        },
        props: ['id'],
        data() {
            return {

                setupItems: [],
                updateMode: true,
                test: '',
                form: {
                    id: this.id,
                    article: [],
                    palletType: [],
                    cropDate: '',
                    cell: [],
                    harvestCycle: '',
                    harvestCycleDay: '',
                    amount: '',
                    note: null
                },
            }
        },
        methods: {
            ...mapActions([
                'getAllFarmerArticles',
                'getAllCells',
                'getAllPalletlabels',
                'getAllPalletTypes',
                'createPalletLabel'
            ]),
            getValidationState({ dirty, validated, valid = null }) {
              return dirty || validated ? valid : null;
            },
            checkSetup() {
                if (!this.farmerArticles.length) {
                    let data = {
                        title: 'You do not have an article selection setup!',
                        description: 'In order to make palletlabels you need to setup a personalized article ' +
                            'selection for your account. So you will only see the articles you want to make labels ' +
                            'for.',
                        linkPath: '/'
                    };
                    this.setupItems.push(data);
                }
                if (!this.cells.length) {
                    let data = {
                        title: 'You do not have any cells setup!',
                        description: 'In order to make palletlabels you need to setup the cells for your account. ' +
                            'So you will only see the cells that you have..',
                        linkPath: '/'
                    };
                    this.setupItems.push(data);
                }
            },
            selectPallettype() {
                let filtered = this.farmerArticles.find(article => article.id === this.form.article.id);
                this.form.palletType = filtered.palletType;
            },

            getPalletLabel() {
                this.$store.dispatch("getPalletLabel", this.id)
            },

            formSubmit() {
                // this.$validator.validateAll().then((result) => {
                //     if (result) {
                            this.$store.dispatch("updatePalletLabel", this.form)
                                .then(() => {
                                    // console.log(this.palletLabel.id);
                                    this.$router.push({name: 'palletlabelPdf', params: {id: this.id}})
                                });
                    //     }
                    // })

            },
            create() {

            },
            cancel() {
                this.$emit('createMode')
            }
        },
        computed: {
            ...mapGetters({
                farmerArticles: 'farmerArticles',
                cells: 'cells',
                palletTypes: 'palletTypes',
                palletLabel: 'palletLabel'
            }),
        },
        mounted() {
            Promise.all([
                // this.getAllFarmerArticles(),
                // this.getAllCells(),
                // this.getAllPalletTypes(),
                this.getPalletLabel()
            ]).finally(() => {
              this.form.article = this.palletLabel.article,
              this.form.palletType = this.palletLabel.article.palletType,
              this.form.cropDate = this.palletLabel.cropDate,
              this.form.cell = this.palletLabel.cell,
              this.form.harvestCycle = this.palletLabel.harvestCycle,
              this.form.harvestCycleDay = this.palletLabel.harvestCycleDay,
              this.form.amount = this.palletLabel.articleAmount,
              this.form.note = this.palletLabel.note
                // this.checkSetup()
                // this.form.cropDate = this.$moment().format('YYYY-MM-DD')
                // this.test = this.$moment().format('YYYY-MM-DD')
            })
        }
    }
</script>

<style scoped>
    .input-error {
        border: 1px solid red;
    }
</style>
