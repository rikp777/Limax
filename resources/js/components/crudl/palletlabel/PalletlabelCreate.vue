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

            <b-card :title="$t('palletlabel.create.title')">
                <div class="position-absolute card-top-buttons">
                    <b-badge class="mb-1" pill variant="info">{{$t('palletlabel.create.modeTitle')}}</b-badge>
                </div>
                <b-form @submit.prevent="formSubmit()">
                    <b-row>

                        <!-- Articles  -->
                        <b-colxx xs="12" xl="6">
                            <b-form-group :label="$t('palletlabel.article.title')">
                                <multiselect
                                    v-if="farmerArticles"
                                    v-model="form.article"
                                    v-validate="'required'"
                                    data-vv-validate-on="change|custom"
                                    :options="farmerArticles"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :allow-empty="false"
                                    placeholder="Pick some"
                                    label="name"
                                    track-by="name"
                                    name="article"
                                    :class="errors.first('article') ? 'input-error' : ''"
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
                                </multiselect>
                                <h6>{{ errors.first('article') }}</h6>
                            </b-form-group>
                        </b-colxx>


                        <!-- PalletTypes  -->
                        <b-colxx xs="12" xl="6">
                            <b-form-group :label="$t('palletlabel.palletType.title')">
                                <multiselect
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


                        <!-- Crop Date  -->
                        <b-colxx xs="12" xl="6">
                            <b-form-group :label="$t('palletlabel.cropDate.title')">
<!--                                <v-date-picker-->
<!--                                    :min-date="new Date()"-->
<!--                                    :dates="new Date()"-->
<!--                                    mode="single"-->
<!--                                    v-model="form.cropDate"-->
<!--                                    :input-props="{ class:'form-control' }"-->
<!--                                />-->
                            </b-form-group>
                            {{this.$moment(form.cropDate).format("YYYY-MM-DD")}}
                        </b-colxx>


                        <!-- Amount  -->
                        <b-colxx xs="12" xl="6">
                            <b-form-group :label="$t('palletlabel.amount.title')">
                                <b-form-input
                                    v-model="form.amount"
                                    type="number"
                                    min="0.00"/>
                            </b-form-group>
                        </b-colxx>


                        <!-- Cell  -->
                        <b-colxx xs="12" xl="4">
                            <b-form-group :label="$t('palletlabel.cell.title')">
                                <multiselect
                                    v-if="form.cell"
                                    v-model="form.cell"
                                    :options="cells"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :allow-empty="false"
                                    placeholder="Pick some"
                                    label="description"
                                    track-by="description"
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


                        <!-- Flight  -->
                        <b-colxx xs="12" xl="4">
                            <b-form-group :label="$t('palletlabel.harvestCycle.title')">
                                <b-form-input
                                    v-model="form.harvestCycle"
                                    type="number"
                                    min="0.00"/>
                            </b-form-group>
                        </b-colxx>


                        <!-- Flight Day -->
                        <b-colxx xs="12" xl="4">
                            <b-form-group :label="$t('palletlabel.harvestCycleDay.title')">
                                <b-form-input
                                    v-model="form.harvestCycleDay"
                                    type="number"
                                    min="0.00"/>
                            </b-form-group>
                        </b-colxx>


                        <!-- Note -->
                        <b-colxx xs="12">
                            <b-form-group :label="$t('palletlabel.note.title')">
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
                                        @click="clear"
                                    >{{ $t('palletlabel.create.actions.buttonClear') }}
                                    </b-button>
                                    <b-button
                                        type="submit"
                                        variant="primary"
                                        class="ml-1"
                                    >{{ $t('palletlabel.create.actions.buttonCreate') }}
                                    </b-button>
                                </div>
                            </b-form-group>

                        </b-colxx>


                    </b-row>


                </b-form>
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
        data() {
            return {

                setupItems: [],
                updateMode: false,
                test: '',
                form: {
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

            formSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if (this.updateMode) {
                            // this.form.cropDate = new Date();
                            this.$store.dispatch("updatePalletLabel", this.form)
                                .then(() => {
                                    // console.log(this.palletLabel.id);
                                    this.$router.push({name: 'palletLabelPdf', params: {id: this.palletLabel.id}})
                                });
                        } else {
                            this.$store.dispatch("createPalletLabel", this.form)
                                .then(() => {
                                    this.$router.push({name: 'palletLabelPdf', params: {id: this.palletLabel.id}})
                                });
                        }
                    }
                })
            },
            create() {

            },
            clear() {
                this.form.article = [],
                    this.form.palletType = [],
                    this.form.cell = [],
                    this.form.harvestCycle = '',
                    this.form.harvestCycleDay = '',
                    this.form.amount = '',
                    this.form.note = null
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
                this.getAllFarmerArticles(),
                this.getAllCells(),
                this.getAllPalletTypes()
            ]).finally(() => {
                this.checkSetup()
                this.form.cropDate = this.$moment().format('YYYY-MM-DD')
                this.test = this.$moment().format('YYYY-MM-DD')
            })
        }
    }
</script>

<style scoped>
    .input-error {
        border: 1px solid red;
    }
</style>
