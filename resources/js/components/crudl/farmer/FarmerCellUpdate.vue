<template>
    <div>
        <validation-observer ref="observer" v-slot="{ invalid }">

        <form v-on:submit.prevent="cellUpdate(form.cell)" autocomplete="off"
              class="text-center p-5">

            <!-- Cell -->
            <validation-provider
                :name="$t('cell.update.label')"
                :rules="{ required: true }"
                v-slot="validationContext"
            >
            <label class="form-group has-float-label">
                <input type="text" class="form-control form-control-lg mb-4" v-model="form.cell.description" :placeholder="$t('cell.Update.label')" id="cell" name="cell" :state="getValidationState(validationContext)" aria-describedby="cell-live-feedback">
                    <span>{{ $t('cell.update.label') }}</span>
            </label>
                <b-form-invalid-feedback id="cell-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
            </validation-provider>

            <!-- Sign in button -->
<!--            <button class="btn btn-primary btn-block my-4 text-white" type="submit" value="Login">Update Cell-->
<!--            </button>-->
            <b-form-group label-align="right">
                <div class="d-flex justify-content-end">
                    <b-button
                        type="button"
                        variant="outline-danger"
                        class="ml-1"
                        @click="cancel"
                    >{{ $t('cell.update.actions.buttonCancel') }}
                    </b-button>
                    <b-button
                        type="submit"
                        :disabled="invalid"
                        variant="primary"
                        class="ml-1"
                    >{{ $t('cell.update.actions.buttonUpdate') }}
                    </b-button>
                </div>
            </b-form-group>
            <!--                        <div class="form-group row" v-if="errors">-->
            <!--                            <ul class="error-messages">-->
            <!--                                <li v-for="(v, k) in errors" :key="k">{{ k }} {{ v | error }}</li>-->
            <!--                            </ul>-->
            <!--                        </div>-->
        </form>
        </validation-observer>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        // TODO
        // this component links a cell to a farmer so
        // the farmer gets a specific list of cells
        name: "FarmerCellUpdate",
        props: ['id'],
        data() {
            return {
                form: {
                   cell: {}
                },
            };
        },
        methods: {
            getValidationState({ dirty, validated, valid = null }) {
                return dirty || validated ? valid : null;
            },
            getAllCells(){
                this.$store.dispatch("getAllCells");
            },
            cellUpdate(cell) {
                this.$store.dispatch("updateCell", cell)
            .then(()=> {
                this.$swal({
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                this.getAllCells()
                this.cancel()

                });
            },
            getCell() {
                this.$store.dispatch("getCell", this.id)
            },
            cancel() {
                this.$emit('reloadMode')
                this.$emit('createMode')
            }
        },
        computed: {
            ...mapGetters({
                // farmerArticles: 'farmerArticles',
                cell: 'cell',
                // palletTypes: 'palletTypes',
                // palletLabel: 'palletLabel'
            }),
        },
        mounted() {
            Promise.all([
                this.$store.dispatch("getCell", this.id).then(()=>{
                    console.log("nu dit");
                })
            ]).finally(() => {
                console.log(this.cell);
                    this.form.cell = this.cell;
                    // this.cancel()
            })
        }
    }
</script>

<style scoped>

</style>
