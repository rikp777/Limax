<template>
    <validation-observer ref="observer" v-slot="{ invalid }">
        <b-form @submit.prevent="validateBeforeSubmit()">
            <b-row>
                <b-colxx xxs="12" xl="6" class="mb-3">
                    <b-card no-body>
                        <b-card-body>
                            <!--                            <p class="lead color-theme-1 mb-1 value">{{palletlabel.weight / 1000}} KG</p>-->
                            <!--                            <p class="mb-0 label text-small text-secondary">{{$t('production.dashboard.expectedNoTax')}}</p>-->

                            <qrcode-drop-zone @decode="onDecode" @init="logErrors">
                                <qrcode-stream @decode="onDecode" @init="onInit"/>
                            </qrcode-drop-zone>

                            <qrcode-capture v-if="noStreamApiSupport" @decode="onDecode"/>

                            <!--                            <qrcode-stream @decode="onDecode"></qrcode-stream>-->
                        </b-card-body>
                    </b-card>
                </b-colxx>
                <b-colxx xxs="12" xl="6" class="mb-3">
                    <b-card no-body>
                        <b-card-body>
<!--                            <p v-for="palletlabel in form.palletlabels" class="lead color-theme-1 mb-1 value">{{palletlabel}}</p>-->

                            <b-row class="row icon-cards-row mb-2">
                                <b-colxx xxs="4" sm="4" md="2" lg="2"  v-for="palletlabel in form.palletlabels">
<!--                                    <icon-card title="ID" icon="simple-icon-tag" :value="palletlabel" />-->
                                    <div class="icon-row-item">
                                        <b-card class="mb-4 text-center" @click="removePalletlabel(palletlabel)">
                                            <i class="simple-icon-tag"/>
                                            <p class="card-text font-weight-semibold mb-0">ID</p>
                                            <p class="lead text-center">{{ palletlabel }}</p>
                                        </b-card>
                                    </div>
                                </b-colxx>
                            </b-row>

<!--                            <b-row v-for="palletlabel in form.palletlabels">-->
<!--                                <h2><b-badge class="lead color-theme-1 value" variant="primary">{{palletlabel}}</b-badge></h2>-->
<!--                            </b-row>-->
<!--                            <h2><b-badge v-for="palletlabel in form.palletlabels" class="lead color-theme-1 value" variant="primary">{{palletlabel}}</b-badge></h2>-->
<!--                            <table style="width:100%">-->
<!--                                <tr>-->
<!--                                    <th>ID</th>-->
<!--                                    <th>Actions</th>-->
<!--                                </tr>-->
<!--                                <tr v-for="palletlabel in form.palletlabels">-->
<!--                                    <td class="lead color-theme-1 mb-1 value">{{palletlabel}}</td>-->
<!--                                    <td>-->
<!--                                        <b-button-->
<!--                                            style="     background-color: Transparent;-->
<!--                                                            background-repeat:no-repeat;-->
<!--                                                            border: none;-->
<!--                                                            cursor:pointer;-->
<!--                                                            overflow: hidden;-->
<!--                                                            outline:none;"-->
<!--                                            class="text-primary"-->
<!--                                        >Delete-->
<!--                                        </b-button>-->
<!--                                    </td>-->
<!--                                </tr>-->
<!--                            </table>-->
                            <!--                            <p class="mb-0 label text-small text-secondary">{{$t('production.dashboard.tax')}}</p>-->
                        </b-card-body>
                    </b-card>
                </b-colxx>
            </b-row>
            <b-form-group label-align="center">
                <div class="d-flex justify-content-center">
                    <!--                    <b-button-->
                    <!--                        type="button"-->
                    <!--                        variant="outline-danger"-->
                    <!--                        class="ml-1"-->
                    <!--                    >{{ $t('palletlabel.create.actions.buttonClear') }}-->
                    <!--                    </b-button>-->
                    <b-button
                        type="submit"
                        variant="primary"
                        class="ml-1"
                        :disabled="invalid"
                    >{{ $t('trucker.dashboard.actions.buttonCreate') }}
                    </b-button>
                </div>
            </b-form-group>
        </b-form>
    </validation-observer>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import {QrcodeStream, QrcodeDropZone, QrcodeCapture} from 'vue-qrcode-reader'
    export default {
        name: 'shippinglabelscan',
        components: {
            QrcodeStream,
            QrcodeDropZone,
            QrcodeCapture
        },
        data() {
            return {
                noStreamApiSupport: false,
                form: {
                    palletlabels: [],
                }
            }
        },
        computed: {
            ...mapGetters({}),
            shippingLabel() {
                return this.$store.getters.shippingLabel
            },
        },
        methods: {
            ...mapActions([]),
            logErrors(promise) {
                promise.catch(console.error)
            },
            removePalletlabel(id) {
                const index = this.form.palletlabels.indexOf(id);
                if (index > -1) {
                    this.form.palletlabels.splice(index, 1);
                }
                console.log('removed' + ' ' + id);
            },
            async onInit(promise) {
                try {
                    await promise
                } catch (error) {
                    if (error.name === 'StreamApiNotSupportedError') {
                        this.noStreamApiSupport = true
                    }
                }
            },
            onDecode(decodedString) {
                console.log(decodedString)
                if (this.form.palletlabels.indexOf(decodedString) === -1) this.form.palletlabels.push(decodedString);
                console.log(this.form.palletlabels)
            },
            truckerupdatePalletLabelStatus() {
                // console.log(this.form);
                this.$store.dispatch("truckerupdatePalletLabelStatus", this.form.palletlabels)
            },
            validateBeforeSubmit() {
                this.truckerupdatePalletLabelStatus();
                // this.createShippingLabel();
                this.$store.dispatch("truckercreateShippingLabel", this.form.palletlabels)
                    .then(() => {
                        this.$router.push({
                            name: 'shippinglabelPdf',
                            params: {id: this.shippingLabel.id}
                        })
                    });
            }
        },
        mounted() {
        }
    }
</script>
