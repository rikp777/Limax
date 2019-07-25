<template>
    <form @submit.prevent="validateBeforeSubmit">


        <div class="form-row">
            <div class="form-group col">
                <label for="cropDate">Crop Date</label>
                <flat-pickr
                        v-model="form.cropDate"
                        name="cropDate"
                        id="cropDate"
                        v-validate="'required|date_format:dd/MM/yyyy'"
                        :class="{ 'is-invalid': errors.has('cropDate') }"
                        class="form-control"
                ></flat-pickr>
                <span class="invalid-feedback">{{ errors.first('cropDate') }}</span>
            </div>
            <div class="form-group col">
                <label for="amount">Amount</label>
                <input
                        v-model="form.amount"
                        type="number"
                        name="amount"
                        id="amount"
                        v-validate="'required|numeric|min_value:1|max_value:180'"
                        :class="{ 'is-invalid': errors.has('amount') }"
                        class="form-control"
                >
                <span class="invalid-feedback">{{ errors.first('amount') }}</span>
            </div>
        </div>


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

                        ref="select"
                        data-live-search="true"
                        data-width="100%"
                >
                    <option disabled value="">Select</option>
                    <option v-for="article in articles.data" v-bind:value="article.id">{{article.name}}</option>
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

                        ref="select"
                        data-live-search="true"
                        data-width="100%"
                >
                    <option disabled value="">Select</option>
                    <option v-for="palletType in palletTypes.data" v-bind:value="palletType.id">{{palletType.name}}
                    </option>
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

                        ref="select"
                        data-live-search="true"
                        data-width="100%"

                        @change="calculate(form.cellId)"
                >
                    <option disabled value="">Select</option>
                    <option v-for="cell in cells.data" v-bind:value="cell.id">{{cell.description}}</option>
                </select>
                <span class="invalid-feedback">{{ errors.first('cell') }}</span>
            </div>
            <div class="form-group col" v-if="calculation.data">
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
            <div class="form-group col" v-if="calculation.data">
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
        <div class="form-row" v-if="calculation.data">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Message!</strong>
                <div v-for="message in calculation.data.calculation.message">
                    {{message}}
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                        v-validate="'required|numeric'"
                        :class="{ 'is-invalid': errors.has('note') }"
                        class="form-control"
                >
                <span class="invalid-feedback">{{ errors.first('note') }}</span>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input
                        id="formCheck"
                        name="formCheck"
                        type="checkbox"
                        v-validate="'required'"
                        :class="{ 'is-invalid': errors.has('formCheck') }"
                        class="form-check-input"
                >
                <label class="form-check-label" for="formCheck">Is everything correct?</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>


</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import FlatPickr from "vue-flatpickr-component/src/component";

    export default {
        name: "palletLabel-create",
        components: {FlatPickr},
        updated() {
            $(this.$refs.select).selectpicker('refresh')
        },
        data() {

            return {
                form: {
                    cropDate: '',
                    amount: '',
                    articleId: '',
                    palletTypeId: '',
                    cellId: '',
                    flight: 0,
                    flightDay: 0,
                    note: '',
                },
                serverErrors: '',
            }
        },
        computed: {
            ...mapGetters({palletLabel: 'palletLabel/single'}),
            ...mapGetters({articles: 'article/getAll'}),
            ...mapGetters({palletTypes: 'palletType/getAll'}),
            ...mapGetters({cells: 'cell/getAll'}),
            ...mapGetters({calculation: 'cultivationCycle/getCalculation'})
        },
        mounted() {
            this.PalletLabelGetById(this.$route.params.id)
                .then((data) => {
                    console.log(this.palletLabel);
                    this.form.cropDate = this.palletLabel.crop_date,
                    this.amount = this.palletLabel.amount,
                    this.articleId = this.palletLabel.article_id,
                    this.palletTypeId = this.palletLabel.pallet_type_id,
                    this.cellId = this.palletLabel.cell_number,
                    this.flight = this.palletLabel.harvest_cycle,
                    this.flightDay = this.palletLabel.harvest_cycle_day,
                    this.note = this.palletLabel.note
                }).catch((error) => {
                console.log('nope')
            });
            this.articleGetAll();
            this.palletTypeGetAll();
            this.cellsGetAll();
        },
        methods: {
            ...mapActions('palletLabel', {PalletLabelGetById: 'getById'}),
            ...mapActions('article', {articleGetAll: 'getAll'}),
            ...mapActions('palletType', {palletTypeGetAll: 'getAll'}),
            ...mapActions('cell', {cellsGetAll: 'getAll'}),
            ...mapActions('cultivationCycle', {getCalculationCell: 'getCalculationCell'}),

            calculate(id) {
                this.getCalculationCell(id)
                    .then(() => {
                        this.palletLabel.flight = this.calculation.data.calculation.flight;
                        this.palletLabel.flightDay = this.calculation.data.calculation.flight_day;
                    });
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.create();
                    }
                })
            },

            create() {
                this.$store.dispatch('user/create', {
                    cropDate: this.cropDate,
                    amount: this.amount,
                    articleId: this.articleId,
                    palletTypeId: this.palletTypeId,
                    cellId: this.cellId,
                    flight: this.flight,
                    flightDay: this.flightDay,
                    note: this.note
                }).then(response => {
                    // this.$router.push({ name: 'userList'})
                }).catch(error => {
                    console.log(error.response.data.errors);
                    this.serverErrors = Object.values(error.response.data.errors)
                })
            },
        },
    }
</script>