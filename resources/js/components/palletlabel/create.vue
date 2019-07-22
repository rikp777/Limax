<template>
    <form>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cropDate">Crop Date</label>
                <flat-pickr v-model="palletLabel.cropDate" id="cropDate" class="form-control"></flat-pickr>
                <!--                <input-->
                <!--                        type="date"-->
                <!--                        name="cropDate"-->
                <!--                        id="cropDate"-->
                <!--                        v-model="palletLabel.cropDate"-->
                <!--                        v-validate="'required|date'"-->
                <!--                        :class="{ 'is-invalid': errors.has('cropDate') }"-->
                <!--                        class="form-control datepicker"-->
                <!--                >-->
                <span class="invalid-feedback">{{ errors.first('cropDate') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="amount">Amount</label>
                <input
                        type="number"
                        name="amount"
                        id="amount"
                        v-model="palletLabel.amount"
                        v-validate="'required|int'"
                        :class="{ 'is-invalid': errors.has('amount') }"
                        class="form-control"
                >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="article" class="d-block">Article</label>
                <select class="selectpicker" id="article" ref="select" v-model="palletLabel.articleId"
                        data-live-search="true" data-width="100%">
                    <option disabled value="">Select</option>
                    <option v-for="article in articles.data" v-bind:value="article.id">{{article.name}}</option>
                </select>
                <span class="invalid-feedback">{{ errors.first('article') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="palletType">Pallet Type</label>
                <select class="selectpicker" id="palletType" ref="select" v-model="palletLabel.palletTypeId"
                        data-live-search="true" data-width="100%">
                    <option disabled value="">Select</option>
                    <option v-for="palletType in palletTypes.data" v-bind:value="palletType.id">{{palletType.name}}</option>
                </select>
                <span class="invalid-feedback">{{ errors.first('palletType') }}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="cell">Cell</label>
                <select class="selectpicker" id="cell" ref="select" v-model="palletLabel.cellId" @change="calculate(palletLabel.cellId)"
                        data-live-search="true" data-width="100%">
                    <option disabled value="">Select</option>
                    <option v-for="cell in cells.data" v-bind:value="cell.id">{{cell.description}}</option>
                </select>
                <span class="invalid-feedback">{{ errors.first('cell') }}</span>
            </div>
            <div class="form-group col-md-4" v-if="calculation.data">
                <label for="flight">Flight</label>
                <input type="number" class="form-control" id="flight" v-model="palletLabel.flight">{{calculation.data.calculation.flight}}
                <span class="invalid-feedback">{{ errors.first('flight') }}</span>
            </div>
            <div class="form-group col-md-4">
                <label for="flightDay">Flight Day</label>
                <input
                        type="number"
                        name="flightDay"
                        id="flightDay"
                        v-model="palletLabel.flightDay"
                        v-validate="'required|int'"
                        :class="{ 'is-invalid': errors.has('flightDay') }"
                        class="form-control"
                >
                <span class="invalid-feedback">{{ errors.first('flightDay') }}</span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="note">Note</label>
                <input
                        type="text"
                        name="note"
                        id="note"
                        v-model="palletLabel.note"
                        v-validate="'required|date'"
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
                // listData:['a','b','c'],
                // select:'b',
                palletLabel: {
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
            ...mapGetters({articles: 'article/getAll'}),
            ...mapGetters({palletTypes: 'palletType/getAll'}),
            ...mapGetters({cells: 'cell/getAll'}),
            ...mapGetters({calculation: 'cultivationCycle/getCalculation'})
        },
        methods: {
            ...mapActions('article', ['getAll']),
            ...mapActions('palletType', { palletTypeGetAll: 'getAll'}),
            ...mapActions('cell', { cellsGetAll: 'getAll'}),
            ...mapActions('cultivationCycle', { getCalculationCell: 'getCalculationCell'}),

            calculate(id){
                this.getAll();
                mapGetters({calculation: 'cultivationCycle/getCalculation'})
                this.palletLabel.flight = calculate.data.calculate.flight;
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
        mounted() {
            if (this.articles.length) {
                return;
            }
            this.getAll();
            this.palletTypeGetAll();
            this.cellsGetAll();
        }
    }
</script>