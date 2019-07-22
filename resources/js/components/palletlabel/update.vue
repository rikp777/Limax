<template>
    <div class="card">
        <div class="card-body">

            <form @submit.prevent="validateBeforeSubmit">
                <div v-if="serverErrors" class="alert alert-warning" role="alert">
                    <div v-for="(value, key) in serverErrors" :key="key">{{ value[0] }}</div>
                </div>

                <div class="form-row">
                    <div class="col mb-3">
                        <label for="cropDate">Crop date</label>
                        <input
                                type="date"
                                name="cropDate"
                                id="cropDate"
                                v-model="palletLabel.cropDate"
                                v-validate="'required|date'"
                                :class="{ 'is-invalid': errors.has('cropDate') }"
                                class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('cropDate') }}</span>
                    </div>
                    <div class="col mb-3">
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
                        <span class="invalid-feedback">{{ errors.first('amount') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col mb-3">
                        <label for="articleId">Article</label>
                        <select class="form-control" id="articleId">
                        </select>
                        <input
                                type="date"
                                name="articleId"
                                id="articleId"
                                v-model="palletLabel.articleId"
                                v-validate="'required|date'"
                                :class="{ 'is-invalid': errors.has('articleId') }"
                                class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('articleId') }}</span>
                    </div>
                    <div class="col mb-3">
                        <label for="palletType">Pallet Type</label>
                        <input
                                type="number"
                                name="palletType"
                                id="palletType"
                                v-model="palletLabel.palletType"
                                v-validate="'required|int'"
                                :class="{ 'is-invalid': errors.has('palletType') }"
                                class="form-control"
                        >
                        <span class="invalid-feedback">{{ errors.first('palletType') }}</span>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Create</button>
            </form>
            <form>

            </form>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    export default {
        name: "palletLabel-update",
        data() {
            return {
                palletLabel: {
                    cropDate: '',
                    amount: '',
                    articleId: '',
                    palletTypeId: '',
                    cellId: '',
                    flight: '',
                    flightDay: '',
                    note: '',
                },
                serverErrors: '',
            }
        },
        computed: mapGetters({
            articles: 'article/articles',
        }),
        methods: {
            validateBeforeSubmit(){
                this.$validator.validateAll().then((result) => {
                    if(result) {
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

                }).catch(error => {
                    console.log(error.response.data.errors);
                    this.serverErrors = Object.values(error.response.data.errors)
                })
            }
        }
    }
</script>