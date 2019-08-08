<template>

    <div class="card-body" :class="{ 'bg-info text-white': updateMode }">
        <h5 v-if="updateMode" class="card-title">Update Mode</h5>
        <form @submit.prevent="validateBeforeSubmit">
            <div class="form-row">
                <div class="form-group col">
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
                        <option v-for="article in articles" v-bind:value="article.id">{{article.name}}</option>
                    </select>
                    <span class="invalid-feedback">{{ errors.first('article') }}</span>
                </div>
                <div class="form-group col">
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
                <div class="form-group col">
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

                        @change="getCultivationCalculationCell(form.cellId)"
                    >
                        <option disabled value="">Select</option>
                        <option v-for="cell in cells" v-bind:value="cell.id">{{cell.description}}</option>
                    </select>
                    <span class="invalid-feedback">{{ errors.first('cell') }}</span>
                </div>
                <div class="form-group col" v-if="calculation.flight">
                    <label for="flight">Flight</label>
                    <input
                        v-model="form.flight"
                        id="flight"
                        name="flight"
                        type="number"
                        v-validate="'required|numeric'"
                        :class="{ 'is-invalid': errors.has('cell') }"
                        class="form-control"
                        disabled
                    >
                    <span class="invalid-feedback">{{ errors.first('flight') }}</span>
                </div>
                <div class="form-group col" v-if="calculation.flight">
                    <label for="flightDay">Flight Day</label>
                    <input
                        v-model="form.flightDay"
                        id="flightDay"
                        name="flightDay"
                        type="number"
                        v-validate="'required|numeric'"
                        :class="{ 'is-invalid': errors.has('flightDay') }"
                        class="form-control"
                        disabled
                    >
                    <span class="invalid-feedback">{{ errors.first('flightDay') }}</span>
                </div>
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
                <div class="form-group col">
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
                <div class="form-group col">
                    <label for="amount">Amount <small>{{form.articleId ? "max: " + articles.find(article => article.id === form.articleId).pallet_limit : "max: " + 180}}</small></label>
                    <input
                        v-model="form.amount"
                        type="number"
                        name="amount"
                        id="amount"
                        :placeholder='(form.articleId ? articles.find(article => article.id === form.articleId).pallet_limit : 180)'
                        v-validate="'required|numeric|min_value:1|max_value:' + (form.articleId ? articles.find(article => article.id === form.articleId).pallet_limit : 180)"
                        :class="{ 'is-invalid': errors.has('amount') }"
                        class="form-control"
                    >
                    <span class="invalid-feedback">{{ errors.first('amount') }}</span>
                </div>
            </div>




            <div class="form-row">
                <div class="form-group col">
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
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="formCheck">
                    <label class="form-check-label" for="formCheck">Is everything correct?</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Print</button>
        </form>
    </div>

</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import FlatPickr from "vue-flatpickr-component/src/component";

    export default {
        name: "palletLabel-create",
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
                    cropDate: Date.now(),
                    amount: '',
                    articleId: '',
                    palletTypeId: '',
                    cellId: '',
                    flight: 0,
                    flightDay: 0,
                    note: '',
                },
                serverErrors: '',
                updateMode: false,
            }
        },
        computed: {
            palletLabel(){
                return this.$store.getters.palletLabel;
            },
            articles(){
                return this.$store.getters.articles;
            },
            palletTypes(){
                return this.$store.getters.palletTypes;
            },
            cells(){
                return this.$store.getters.cells;
            },
            calculation(){
                return this.$store.getters.calculation
            },
        },
        mounted(){
            this.getAllArticles();
            this.getAllPalletTypes();
            this.getAllCells();
            this.mode(this.updateId);
        },
        methods: {
            getPalletLabel(id){
                this.$store.dispatch("getPalletLabel", id)
                    .then(() => {
                        this.form.cropDate = this.palletLabel.crop_date;
                        this.form.amount = this.palletLabel.article_amount;
                        this.form.articleId = this.palletLabel.article_id;
                        this.form.palletTypeId = this.palletLabel.pallet_type_id,
                        this.form.cellId = this.palletLabel.cell_id;
                        this.form.flight = this.palletLabel.harvest_cycle;
                        this.form.flightDay = this.palletLabel.harvest_cycle_day;
                        this.form.note = this.palletLabel.note;
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
                        this.form.flight = this.calculation.flight;
                        this.form.flightDay = this.calculation.flight_day;
                    })
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        if(this.updateMode){
                            this.update();
                        }else{
                            this.create();
                        }
                    }
                })
            },
            selectPallettype(selectedArticleId) {
                let filtered = this.articles.data.find(article => article.id === selectedArticleId);
                this.form.palletTypeId = filtered.pallet_type.id;
            },
            mode(id){
                if(id || this.$route.params.id){
                    if(this.$route.params.id){
                        id = this.$route.params.id
                    }
                    console.log("update mode");
                    this.updateMode = true;
                    this.getPalletLabel(id)
                }
            },

            create(){

            },
            update(){

            },
        },
    }
</script>
