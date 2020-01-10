<template>
    <div class="card-body" :class="{ 'updatemodeStyle': updateMode }" v-if="cellsCount">
        <template v-if="false">
            <h3>loading...</h3>
        </template>
        <template v-else>
            <template v-if="updateMode">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title"><b>Update Mode</b></h5>
                    </div>
                    <div class="col" >
<!--                        <font-awesome-icon icon="list-alt" class="menu-icon" @click="mode(0)">Cancel</font-awesome-icon>-->
<!--                        <button class="btn btn-secondary float-right" @click="mode(0)">Cancel</button>-->
                    </div>
                </div>
            </template>

            <div v-if="!articlefarmers.length">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">You do not have an article selection setup!</h4>
                    <p>In order to make palletlabels you need to setup a personalized article selection for your account. So you will only see the articles you want to make labels for.</p>
                    <hr>
                    <p class="mb-0">Whenever you're ready press the button</p>
                    <br>
                    <p><router-link class="btn btn-primary text-white" :to="{ name: 'settingsRead'}">Settings</router-link></p>
                </div>
            </div>
            <div v-if="!cells.length">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">You do not have any cells setup!</h4>
                    <p>In order to make palletlabels you need to setup the cells for your account. So you will only see the cells that you have..</p>
                    <hr>
                    <p class="mb-0">Whenever you're ready press the button</p>
                    <br>
                    <p><router-link class="btn btn-primary text-white" :to="{ name: 'settingsRead'}">Settings</router-link></p>
                </div>
            </div>

            <form @submit.prevent="validateBeforeSubmit">
                <div class="form-row">
                    <div class="form-group col" v-if="articlefarmers.length && cells.length">
                        <label for="article" class="d-block">Article</label>
                        <select
                            v-model="form.articleId"
                            id="article"
                            name="article"
                            v-validate="'required|numeric'"
                            :class="{ 'is-invalid': errors.has('article') }"
                            class="selectpicker"

                            ref="selectArticle"
                            data-live-search="true"
                            data-width="100%"

                            @change="selectPallettype(form.articleId)"
                        >
                            <option disabled value="">Select</option>
                            <option v-for="article in articlefarmers" v-bind:value="article.id">{{article.name}}</option>
                        </select>
                        <div class="invalid-feedback">{{ errors.first('article') }}</div>
                    </div>
                    <div class="form-group col" v-if="form.articleId">
                        <label for="palletType">Pallet Type</label>
                        <select
                            v-model="form.palletTypeId"
                            id="palletType"
                            name="palletType"
                            v-validate="'required|numeric'"
                            :class="{ 'is-invalid': errors.has('palletType') }"
                            class="selectpicker"

                            ref="selectPalletType"
                            data-live-search="true"
                            data-width="100%"
                        >
                            <option disabled value="">Select</option>
                            <option v-for="palletType in palletTypes" v-bind:value="palletType.id">{{palletType.name}}</option>
                        </select>
                        <span class="invalid-feedback">{{ errors.first('palletType') }}</span>
                    </div>
                </div>




                <div class="form-row">
                    <div class="form-group col" v-if="form.palletTypeId">
                        <label for="cell">Cell</label>
                        <select
                            v-model="form.cellId"
                            id="cell"
                            name="cell"
                            v-validate="'required|numeric'"
                            :class="{ 'is-invalid': errors.has('cell') }"
                            class="selectpicker"

                            ref="selectCell"
                            data-live-search="true"
                            data-width="100%"
                            @change="this.consolelogfunctionsigh"
                        >
<!--                            @change="getCultivationCalculationCell(form.cellId)"-->

<!--                        >-->
                            <option disabled value="">Select</option>
                            <option v-for="cell in cells" v-bind:value="cell.id">{{cell.description}}</option>
                        </select>
                        <span class="invalid-feedback">{{ errors.first('cell') }}</span>
                    </div>
                    <div class="form-group col" v-if="form.cellId">
                        <label for="flight">Flight</label>
                        <input
                            v-model="form.harvestCycle"
                            id="flight"
                            name="flight"
                            type="number"
                            v-validate="'required|numeric'"
                            :class="{ 'is-invalid': errors.has('harvestCycle') }"
                            class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('flight') }}</span>
                    </div>
                    <div class="form-group col" v-if="form.harvestCycle">
                        <label for="flightDay">Flight Day</label>
                        <input
                            v-model="form.harvestCycleDay"
                            id="flightDay"
                            name="flightDay"
                            type="number"
                            v-validate="'required|numeric'"
                            :class="{ 'is-invalid': errors.has('harvestCycleDay') }"
                            class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('harvestCycleDay') }}</span>
                    </div>
<!--                    <div class="form-group col" v-if="calculation.harvestCycle">-->
<!--                        <label for="flight">Flight</label>-->
<!--                        <input-->
<!--                            v-model="form.harvestCycle"-->
<!--                            id="flight"-->
<!--                            name="flight"-->
<!--                            type="number"-->
<!--                            v-validate="'required|numeric'"-->
<!--                            :class="{ 'is-invalid': errors.has('harvestCycle') }"-->
<!--                            class="form-control"-->
<!--                            disabled-->
<!--                        >-->
<!--                        <span class="invalid-feedback">{{ errors.first('flight') }}</span>-->
<!--                    </div>-->
<!--                    <div class="form-group col" v-if="calculation.harvestCycleDay">-->
<!--                        <label for="flightDay">Flight Day</label>-->
<!--                        <input-->
<!--                            v-model="form.harvestCycleDay"-->
<!--                            id="flightDay"-->
<!--                            name="flightDay"-->
<!--                            type="number"-->
<!--                            v-validate="'required|numeric'"-->
<!--                            :class="{ 'is-invalid': errors.has('harvestCycleDay') }"-->
<!--                            class="form-control"-->
<!--                            disabled-->
<!--                        >-->
<!--                        <span class="invalid-feedback">{{ errors.first('harvestCycleDay') }}</span>-->
<!--                    </div>-->
                </div>

                <div class="form-row" v-if="calculation.message">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Message!</strong>
                        <div v-for="message in calculation.message">
                            {{message}}
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>




                <div class="form-row">
                    <div class="form-group col" v-if="form.harvestCycleDay">
                        <label for="cropDate">Crop Date</label>
                        <flat-pickr
                            v-model="form.cropDate"
                            name="cropDate"
                            id="cropDate"
                            v-validate="'required'"
                            :class="{ 'is-invalid': errors.has('cropDate') }"
                            class="form-control"
                        ></flat-pickr>
                        <span class="invalid-feedback">{{ errors.first('cropDate') }}</span>
                    </div>
                    <div class="form-group col" v-if="form.harvestCycleDay">
                        <label for="amount">Amount <small>{{form.articleId ? "max: " + articles.find(article => article.id === form.articleId).palletLimit : "max: " + 180}}</small></label>
                        <input
                            v-model="form.articleAmount"
                            type="number"
                            name="amount"
                            id="amount"
                            :placeholder='(form.articleId ? articles.find(article => article.id === form.articleId).palletLimit : 180)'
                            :class="{ 'is-invalid': errors.has('articleAmount') }"
                            class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('articleAmount') }}</span>
                    </div>
                </div>




                <div class="form-row">
                    <div class="form-group col" v-if="form.articleAmount">
                        <label for="note">Note</label>
                        <input
                            v-model="form.note"
                            id="note"
                            name="note"
                            type="text"
                            v-validate="'required'"
                            :class="{ 'is-invalid': errors.has('note') }"
                            class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('note') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check" v-if="form.note">
                        <input type="checkbox" class="form-check-input" id="formCheck" v-model="isChecked">
                        <label class="form-check-label" for="formCheck">Is everything correct?</label>
                    </div>
                </div>
<!--                <button type="submit" class="btn btn-primary text-white">Print</button>-->
                <button type="button" class="btn btn-primary text-white" v-if="isChecked" @click="validateBeforeSubmit">Print</button>
<!--                <router-link type="submit" class="btn btn-primary" :to="{ name: 'palletLabelPdf', params: { id: 1 }}">Print</router-link>-->
            </form>
        </template>
    </div>

</template>

<script>
    import FlatPickr from "vue-flatpickr-component/src/component";
    import router from "../../router";
    import palletLabel from "../../router/routes/palletLabel";

    export default {
        name: "palletlabel-create",
        components: {FlatPickr},
        props: ['updateId'],


        updated() {
            $(this.$refs.selectArticle).selectpicker('refresh');
            $(this.$refs.selectCell).selectpicker('refresh');
            $(this.$refs.selectPalletType).selectpicker('refresh')
        },

        data() {
            return {
                form: {
                    id: '',
                    // cropDate: Date.now(),
                    cropDate: '',
                    articleAmount: '',
                    articleId: '',
                    palletTypeId: '',
                    cellId: '',
                    // harvestCycle: 0,
                    // harvestCycleDay: 0,
                    harvestCycle: '',
                    harvestCycleDay: '',
                    note: '',
                },
                isChecked: '',
                serverErrors: '',
                updateMode: false,
                isMounted: false
            }
        },
        computed: {
            articlefarmers() {
                return this.$store.getters.articlefarmers;
            },
            palletLabel(){
                return this.$store.getters.palletLabel;
            },
            palletLabels(){
                return this.$store.getters.palletLabels;
            },
            articles(){
                return this.$store.getters.articles;
            },
            palletTypes(){
                return this.$store.getters.palletTypes;
            },
            cellsCount(){
                return this.$store.getters.cellsCount;
            },
            cells(){
                return this.$store.getters.cells;
            },
            calculation(){
                return this.$store.getters.calculation
            },

            palletLabelIsLoading(){
                return this.$store.getters.palletLabelIsLoading;
            },
            articleIsLoading(){
                return this.$store.getters.articleIsLoading;
            }
        },
        mounted(){
            this.getAllArticleFarmers();
            this.getAllPalletLabels();
            this.getAllArticles();
            this.getAllPalletTypes();
            this.getAllCells();
            this.mode(this.updateId);
            this.form.cropDate = moment().format("YYYY-MM-DD");
        },
        methods: {
            getAllArticleFarmers() {
                this.$store.dispatch("getAllArticleFarmers");
            },
            getAllPalletLabels() {
                this.$store.dispatch("getAllPalletLabels");
            },
            isLoading(){
                return false;
            },
            createPalletLabel(){
                this.$store.dispatch("createPalletLabel", this.form)
            },
            updatePalletLabel(){
                // console.log(this.form);
                this.$store.dispatch("updatePalletLabel", this.form)
            },
            getPalletLabel(id){
                this.$store.dispatch("getPalletLabel", id)
                    .then(() => {
                        this.form = this.palletLabel;
                    });
            },
            getAllArticles(){
                this.$store.dispatch("getAllArticles");
            },
            getAllPalletTypes(){
                this.$store.dispatch("getAllPalletTypes")
            },
            getAllCells(){
                this.$store.dispatch("getAllCells")
            },
            getCultivationCalculationCell(id){
                this.$store.dispatch("getCultivationCalculationCell", id)
                    .then(() => {
                        this.form.harvestCycle = this.calculation.harvestCycle;
                        this.form.harvestCycleDay = this.calculation.harvestCycleDay;
                    })
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if(this.updateMode){

                            this.$store.dispatch("updatePalletLabel", this.form)
                                .then(()=>{
                                    // console.log(this.palletLabel.id);
                                    this.$router.push({ name: 'palletLabelPdf', params: { id: this.palletLabel.id } })
                                });
                        }else{

                            this.$store.dispatch("createPalletLabel", this.form)
                                .then(()=>{
                                this.$router.push({ name: 'palletLabelPdf', params: { id: this.palletLabel.id } })
                            });
                            //desperate times
                            // const routerConst = this.$router;
                            // let idConst = null;
                            // if(this.palletLabels[0] === undefined){
                            //     idConst = 1;
                            // }else{
                            //     idConst = this.palletLabels[0].id+1
                            // }
                            // // console.log(idConst);
                            // setTimeout(function(){
                            //     routerConst.push({ name: 'palletLabelPdf', params: { id: idConst } })
                            // }, 400);
                        }
                    }
                })
            },
            selectPallettype(selectedArticleId) {
                console.log(selectedArticleId);
                let filtered = this.articles.find(article => article.id === selectedArticleId);
                this.form.palletTypeId = filtered.palletType.id;
            },
            consolelogfunctionsigh() {
                console.log(this.form.cellId);
            },
            mode(id){
                if(id >= 1 || this.$route.params.id){
                    if(this.$route.params.id){
                        id = this.$route.params.id
                    }
                    console.log("update mode");
                    this.form.id = id;
                    this.updateMode = true;
                    this.getPalletLabel(id)
                }else{
                    this.errors.clear();
                    this.updateMode = false;
                    this.form.id = '';
                    this.form.cropDate =Date.now();
                    this.form.articleAmount = '';
                    this.form.articleId = '';
                    this.form.palletTypeId= '';
                    this.form.cellId= '';
                    this.form.harvestCycle= 0;
                    this.form.harvestCycleDay= 0;
                    this.form.note= '';
                    // this.updateMode = false;

                }
            },
        }
    }
</script>
<style>
    .disabled.selected.active {
        background-color: transparent;
    }
    .selected.active {
        background-color: #F2AB58
    }
    .updatemodeStyle {
        background-color: #313c6a;
        color: white;
    }
</style>
