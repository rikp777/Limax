<template>
    <validation-observer ref="observer" v-slot="{ invalid }">
        <b-form @submit.prevent="validateBeforeSubmit()">
            <b-row>
                <b-colxx xxs="12" xl="6" class="mb-3">
                        <b-card-body>
                            <b-button
                                type="button"
                                variant="secondary"
                                class="ml-1"
                                :disabled="invalid"
                                @click="onDecode(116)"
                            >palletlabel 116
                            </b-button>
<!--                            <p class="error">{{ error }}</p>-->
<!--                            <qrcode-stream @decode="onDecode" @init="onInit" />-->
<!--                            <p class="error" v-if="noFrontCamera">-->
<!--                                You don't seem to have a front camera on your device-->
<!--                            </p>-->

<!--                            <p class="error" v-if="noRearCamera">-->
<!--                                You don't seem to have a rear camera on your device-->
<!--                            </p>-->

<!--                            <qrcode-stream :camera="camera" @init="onInit">-->
<!--                                <button type="button" @click="switchCamera">-->
<!--                                    switch camera-->
<!--                                </button>-->
<!--                            </qrcode-stream>-->
                            <qrcode-drop-zone @decode="onDecode" @init="logErrors">
                                <qrcode-stream :camera="camera" @decode="onDecode" @init="onInit"/>
                            </qrcode-drop-zone>
                            <qrcode-capture v-if="noStreamApiSupport" @decode="onDecode"/>
                        </b-card-body>
                </b-colxx>
                <b-colxx xxs="12" xl="6" class="mb-3">
                        <b-card-body>
                            <b-row class="row icon-cards-roww mb-2">
                                <b-colxx xxs="4" sm="4" md="2" lg="2"  v-for="palletlabel in form.palletlabels">
                                    <div class="icon-row-item">
                                            <b-card class="mb-2 text-center" @click="removePalletlabel(palletlabel)">
                                            <i class="simple-icon-tag"/>
                                            <p class="card-text font-weight-semibold">{{ palletlabel }}</p>
                                        </b-card>
                                    </div>
                                </b-colxx>
                            </b-row>
                        </b-card-body>
                </b-colxx>
            </b-row>
            <b-form-group label-align="center">
                <div class="d-flex justify-content-center">
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
                camera: 'rear',
                noRearCamera: false,
                noFrontCamera: false,
                noStreamApiSupport: false,
                error: '',
                form: {
                    palletlabels: [],
                    farmid: null,
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

            switchCamera () {
                switch (this.camera) {
                    case 'front':
                        this.camera = 'rear'
                        break
                    case 'rear':
                        this.camera = 'front'
                        break
                }
            },

            showLoading(){
                this.$swal({
                    title: 'Vrachtbrief laden, ogenblik geduld.',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    timer: 2000,
                    onOpen: () => {
                       this.$swal.showLoading();
                    }
                }).then(
                    () => {},
                    (dismiss) => {
                        if (dismiss === 'timer') {
                            console.log('closed by timer!!!!');
                            this.$swal({
                                title: 'Finished!',
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            })
                        }
                    }
                )
            },

            removePalletlabel(id) {
                const index = this.form.palletlabels.indexOf(id);
                if (index > -1) {
                    this.form.palletlabels.splice(index, 1);
                }
                console.log('removed' + ' ' + id);
            },
            // async onInit (promise) {
            //     try {
            //         await promise
            //     } catch (error) {
            //         if (error.name === 'NotAllowedError') {
            //             this.error = "ERROR: you need to grant camera access permisson"
            //         } else if (error.name === 'NotFoundError') {
            //             this.error = "ERROR: no camera on this device"
            //         } else if (error.name === 'NotSupportedError') {
            //             this.error = "ERROR: secure context required (HTTPS, localhost)"
            //         } else if (error.name === 'NotReadableError') {
            //             this.error = "ERROR: is the camera already in use?"
            //         } else if (error.name === 'OverconstrainedError') {
            //             this.error = "ERROR: installed cameras are not suitable"
            //         } else if (error.name === 'StreamApiNotSupportedError') {
            //             this.error = "ERROR: Stream API is not supported in this browser"
            //         }
            //     }
            // },
            // async onInit (promise) {
            //     try {
            //         await promise
            //     } catch (error) {
            //         const triedFrontCamera = this.camera === 'front'
            //         const triedRearCamera = this.camera === 'rear'
            //
            //         const cameraMissingError = error.name === 'OverconstrainedError'
            //
            //         if (triedRearCamera && cameraMissingError) {
            //             this.noRearCamera = true
            //         }
            //
            //         if (triedFrontCamera && cameraMissingError) {
            //             this.noFrontCamera = true
            //         }
            //
            //         console.error(error)
            //     }
            // },
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
                // console.log(decodedString)
                Promise.all([
                    this.$store.dispatch("checkScannedLabel", decodedString).then(() => {
                    })
                ]).finally(() => {

                    //check if label exists in database
                    if (this.shippingLabel.palletlabel === null){
                        this.$swal({
                            position: 'center',
                            icon: 'error',
                            title: 'Label bestaat niet',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    } else {
                        // console.log(this.shippingLabel);
                        if (this.shippingLabel.status === "true"){
                            this.$swal({
                                position: 'center',
                                icon: 'error',
                                title: 'Label staat niet meer in koelcel',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        } else {
                            if (this.form.palletlabels.indexOf(decodedString) === -1) {
                                this.form.palletlabels.push(decodedString);
                                this.form.farmid = this.shippingLabel.palletlabel.farmerId;
                            }
                        }
                    }
                })

                // console.log(this.form.palletlabels)
            },
            truckerupdatePalletLabelStatus() {
                // console.log(this.form);
                this.$store.dispatch("truckerupdatePalletLabelStatus", this.form.palletlabels)
            },
            validateBeforeSubmit() {
                this.showLoading();
                this.truckerupdatePalletLabelStatus();
                // this.createShippingLabel();
                this.$store.dispatch("truckercreateShippingLabel", this.form)
                    .then(() => {
                        this.$router.push({
                            name: 'shippinglabelPdf',
                            params: {id: this.shippingLabel.id}
                        })
                    });
            }
        },
        mounted() {
            // this.showLoading()
        }
    }
</script>
