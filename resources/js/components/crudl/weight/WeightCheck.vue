<template>
    <validation-observer ref="observer" v-slot="{ invalid }">
        <b-form @submit.prevent="validateBeforeSubmit()">
            <b-row>
                <b-colxx xxs="4" class="mb-4">
                    <b-card no-body>
                        <b-card-body>
                            <p class="lead color-theme-1 mb-1 value">{{palletlabel.weight / 1000}} KG</p>
                            <p class="mb-0 label text-small">{{$t('report.totalpallets')}}</p>
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="4" class="mb-4">
                    <b-card no-body>
                        <b-card-body>
                            <p class="lead color-theme-1 mb-1 value">{{percentage}} %</p>
                            <p class="mb-0 label text-small">{{$t('report.avgweight')}}</p>
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="4" class="mb-4">
                    <b-card no-body>
                        <b-card-body>
                            <p class="lead color-theme-1 mb-1 value">{{((palletlabel.weight * margin).toFixed(2) / 1000)}}</p>
                            <p class="mb-0 label text-small">{{$t('report.avgweight')}} | 4%</p>
                        </b-card-body>
                    </b-card>
                </b-colxx>
            </b-row>
            <hr>
            <b-row>
                <b-colxx xl="6" md="6">
                    <!-- FirstName -->
                    <validation-provider
                        name="id"
                        :rules="{
                                    required: true,
                                }"
                        v-slot="validationContext"
                    >
                        <b-form-group label="id">
                            <b-form-input
                                type="text"
                                class="form-control"
                                v-model="form.palletlabelId"
                                :state="getValidationState(validationContext)"
                                aria-describedby="palletlabelid-live-feedback"
                                @change="getPalletLabel(form.palletlabelId)"/>
                            <b-form-invalid-feedback id="palletlabelid-live-feedback">
                                {{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </b-form-group>
                    </validation-provider>
                </b-colxx>
                <b-colxx xl="6" md="6">
                    <!-- FirstName -->
                    <validation-provider
                        name="gewicht"
                        :rules="{
                                    required: true,
                                }"
                        v-slot="validationContext"
                    >
                        <b-form-group label="gewicht">
                            <b-form-input
                                type="text"
                                class="form-control"
                                v-model="form.weight"
                                :state="getValidationState(validationContext)"
                                aria-describedby="weight-live-feedback"
                                @change="check()"/>
                            <b-form-invalid-feedback id="weight-live-feedback">
                                {{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </b-form-group>
                    </validation-provider>
                </b-colxx>
            </b-row>
        </b-form>
    </validation-observer>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import Colxx from "../../Common/Colxx";

    export default {
        name: 'weightCheck',
        components: {Colxx},
        data() {
            return {
                valid: null,
                margin: 1.04,
                weight: 0,
                percentage: 0,
                form: {
                    palletlabelId: '',
                    weight: 0,
                }
            }
        },
        computed: {
            ...mapGetters({
                palletlabel: 'palletLabel',
            }),
        },
        methods: {
            ...mapActions([
                'getPalletLabel',
            ]),
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            validateBeforeSubmit() {
                this.create();
            },
            check(){
                console.log(this.palletlabel.weight * this.margin);
                if(this.form.weight < (this.palletlabel.weight * this.margin)){
                    this.valid = false;
                }else{
                    this.valid = true;
                }
                this.percentage = ((((this.form.weight)) / ((this.palletlabel.weight * this.margin) / 1000) * 100) - 100).toFixed(2);
                this.$emit('valid', this.valid)
            }
        },
    }
</script>
