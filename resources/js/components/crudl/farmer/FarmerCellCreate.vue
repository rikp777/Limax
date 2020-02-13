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
                <input type="text" class="form-control form-control-lg mb-4" v-model="form.cell" :placeholder="$t('cell.create.label')" id="cell" name="cell" :state="getValidationState(validationContext)" aria-describedby="cell-live-feedback">
                <span>{{ $t('cell.create.label') }}</span>
            </label>
                <b-form-invalid-feedback id="cell-live-feedback">{{ validationContext.errors[0] }}</b-form-invalid-feedback>
            </validation-provider>
            <!-- Sign in button -->
            <button class="btn btn-primary btn-block my-4 text-white" type="submit" value="CellCreate" :disabled="invalid">{{ $t('cell.create.actions.buttonCreate') }}
            </button>


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
    export default {
        // TODO
        // this component links a cell to a farmer so
        // the farmer gets a specific list of cells
        name: "FarmerCellCreate",
        data() {
            return {
                form: {
                    cell: ''
                },
            };
        },
        methods: {
            getValidationState({ dirty, validated, valid = null }) {
                return dirty || validated ? valid : null;
            },
            cellUpdate(cell) {
                this.$store.dispatch("createCell", cell)
                    .then(()=> {
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.form.cell = '';
                        this.getAllCells()
                        this.$emit('reloadMode')
                    });
            },
            getAllCells(){
                this.$store.dispatch("getAllCells");
            },
        },
        mounted() {
        }
    }
</script>

<style scoped>

</style>
