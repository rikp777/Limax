<template>
    <b-row>
        <div class="loading" v-if="loadingPDF === true">
        </div>
        <b-colxx md="12" class="mb-4" v-else>
            <validation-observer ref="observer" v-slot="{ invalid }">
                <b-form @submit.prevent="validateBeforeSubmit()">
                    <b-row>
                        <!--                        //trucker-->
                        <b-colxx xs="12" xl="6">
                            <validation-provider
                                :name="$t('shippinglabel.attributes.trucker.title')"
                                :rules="{ required: true }"
                                v-slot="validationContext"
                            >
                                <b-form-group :label="$t('shippinglabel.attributes.trucker.title')" id="trucker-group" label-for="trucker">
                                    <!--                                {{trucks}}-->
                                    <multiselect
                                        v-model="form.trucker"
                                        :options="truckers"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        :allow-empty="false"
                                        placeholder="Pick some"
                                        label="fullName"
                                        track-by="fullName"
                                        id="trucker"
                                        name="trucker"
                                        :state="getValidationState(validationContext)"
                                        aria-describedby="trucker-live-feedback"
                                        @input="selectTruck()"
                                    >

                                        <template
                                            slot="selection"
                                            slot-scope="{ values, search, isOpen }">
                                    <span
                                        class="multiselect__single"
                                        v-if="values.length &amp;&amp; !isOpen">
                                      {{ values.length }} options selected
                                    </span>
                                        </template>
                                    </multiselect>
                                    <b-form-invalid-feedback id="trucker-live-feedback">{{ validationContext.errors[0]
                                        }}
                                    </b-form-invalid-feedback>
                                </b-form-group>
                            </validation-provider>

                        </b-colxx>
                        <!--                        //truck-->
                        <b-colxx xs="12" xl="6">
                            <validation-provider
                                :name="$t('shippinglabel.attributes.trucks.title')"
                                :rules="{ required: true }"
                                v-slot="validationContext"
                            >
                                <b-form-group :label="$t('shippinglabel.attributes.trucks.title')">
                                    <!--                                {{trucks}}-->
                                    <multiselect
                                        v-model="form.truck"
                                        :options="trucks"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        :allow-empty="false"
                                        placeholder="Pick some"
                                        label="licensePlate"
                                        track-by="licensePlate"
                                        id="licensePlate"
                                        name="licensePlate"
                                        :state="getValidationState(validationContext)"
                                        aria-describedby="licensePlate-live-feedback"
                                    >
                                        <template
                                            slot="selection"
                                            slot-scope="{ values, search, isOpen }">
                                    <span
                                        class="multiselect__single"
                                        v-if="values.length &amp;&amp; !isOpen">
                                      {{ values.length }} options selected
                                    </span>
                                        </template>
                                    </multiselect>
                                    <b-form-invalid-feedback id="licensePlate-live-feedback">{{
                                        validationContext.errors[0] }}
                                    </b-form-invalid-feedback>
                                </b-form-group>
                            </validation-provider>
                        </b-colxx>
                        <!--                        //date-->
                        <!--                        //palletlabelSelect-->
                    </b-row>
                    <b-row>
                        <!--                        //truck-->
                        <b-colxx xs="12" xl="6">
                            <validation-provider
                                :name="$t('shippinglabel.attributes.deliveryDate.title')"
                                :rules="{ required: true }"
                                v-slot="validationContext"
                            >
                                <b-form-group :label="$t('shippinglabel.attributes.deliveryDate.title')">
                                    <!--                                {{trucks}}-->
                                    <vue-flatpickr-component
                                        v-model="form.deliveryDate"
                                        name="deliveryDate"
                                        id="deliveryDate"
                                        class="form-control"
                                        static='true'
                                        :state="getValidationState(validationContext)"
                                        aria-describedby="deliveryDate-live-feedback"
                                    />
                                    <b-form-invalid-feedback id="deliveryDate-live-feedback">{{
                                        validationContext.errors[0] }}
                                    </b-form-invalid-feedback>
                                </b-form-group>
                            </validation-provider>

                        </b-colxx>
                    </b-row>
                    <div class="separator mb-5"/>

                    <div class="disable-text-selection" v-if="next === true">
                        <!--    <b-row class="app-row survey-app">-->
                        <b-colxx xxs="12">
                            <div class="mb-2">
                                <!--                            <h4>{{ $t('menu.todo') }}</h4>-->
                                <div class="top-right-button-container">
                                    <b-button variant="primary" size="ml-1"
                                              class="top-right-button">
                                        <router-link :to="{ name: 'palletlabelCreate' }" class="text-white"> {{$t('shippinglabel.create.actions.palletlabelCreate') }}</router-link>
                                    </b-button>

                                    <b-button-group v-if="isLoading">
                                        <b-dropdown split right @click="selectAll(true)" class="check-button"
                                                    variant="primary">
                                            <label class="custom-control custom-checkbox pl-4 mb-0 d-inline-block"
                                                   slot="button-content">
                                                <input class="custom-control-input" type="checkbox"
                                                       :checked="isSelectedAll()"
                                                       v-shortkey="{select: ['ctrl','a'], undo: ['ctrl','d']}"
                                                       @shortkey="keymap"/>
                                                <span :class="{
                      'custom-control-label' :true,
                      'indeterminate' : isAnyItemSelected()
                    }">&nbsp;</span>
                                            </label>
                                            <!--                                        <b-dropdown-item>{{$t('todo.action')}}</b-dropdown-item>-->
                                            <!--                                        <b-dropdown-item>{{$t('todo.another-action')}}</b-dropdown-item>-->
                                        </b-dropdown>
                                    </b-button-group>

                                </div>
                                <!--                            <piaf-breadcrumb />-->
                                <div class="breadcrumb"><h4>{{ $t('shippinglabel.create.actions.palletlabels') }}</h4>
                                </div>
                            </div>
                            <div class="mb-2">
                                <b-button variant="empty" class="pt-0 pl-0 d-inline-block d-md-none"
                                          v-b-toggle.displayOptions>
                                    {{ $t('todo.display-options') }} <i class="simple-icon-arrow-down align-middle"/>
                                </b-button>
                                <b-collapse id="displayOptions" class="d-md-block">
                                    <div class="d-block d-md-inline-block pt-1">
                                        <!--                                    <b-dropdown id="ddown1" :text="`${$t('todo.orderby')} ${sort.label}`"-->
                                        <!--                                                variant="outline-dark" class="mr-1 float-md-left btn-group " size="xs">-->
                                        <!--                                        <b-dropdown-item v-for="(order,index) in sortOptions" :key="`order${index}`"-->
                                        <!--                                                         @click="changeOrderBy(order)">{{ order.label }}-->
                                        <!--                                        </b-dropdown-item>-->
                                        <!--                                    </b-dropdown>-->
                                        <!--                                    <div class="search-sm d-inline-block float-md-left mr-1 align-top">-->
                                        <!--                                        <b-input :placeholder="$t('menu.search')" v-model="search"/>-->
                                        <!--                                    </div>-->
                                    </div>
                                </b-collapse>
                            </div>
                            <div class="separator mb-5"/>

                            <b-row v-if="isLoading" key="itemList">
                                <b-colxx xxs="12" v-for="(item,index) in palletLabels" :key="`item${index}`"
                                         v-contextmenu:contextmenu>
                                    <!--                                //start comp-->
                                    <b-card @click.prevent="toggleItem($event,item)"
                                            :class="{'d-flex mb-3':true,'active' : form.palletLabels.includes(item)}"
                                            no-body>
                                        <div class="d-flex flex-grow-1 min-width-zero">
                                            <b-card-body
                                                class="align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center pb-2">
                                                <a href="#"
                                                   class="list-item-heading mb-0 truncate w-50 w-xs-100  mb-1 mt-1"
                                                   @click.prevent="">
<!--                                                    <i :class="{'heading-icon':true,-->
<!--                                'simple-icon-check' : 'COMPLETED' === 'COMPLETED',-->
<!--                                'simple-icon-refresh' : 'PENDING' !== 'COMPLETED'-->
<!--                            }"/>-->
                                                    <span
                                                        class="align-middle d-inline-block">{{item.article.name}}</span>
                                                </a>
                                                <p class="mb-1 text-muted text-small w-15 w-xs-100">{{item.palletLabelFarmerId}}</p>
                                                <p class="mb-1 text-muted text-small w-15 w-xs-100">
                                                    {{item.cropDate}}</p>
                                                <p class="mb-1 text-muted text-small w-15 w-xs-100">
                                                    {{item.articleAmount}}</p>
                                                <!--                                            <div class="w-15 w-xs-100"><b-badge :variant="'green'" pill>label</b-badge></div>-->
                                            </b-card-body>
                                            <div
                                                class="custom-control custom-checkbox pl-1 align-self-md-center align-self-start mr-4 pt-4">
                                                <b-form-checkbox :checked="form.palletLabels.includes(item)"
                                                                 class="itemCheck mb-0"/>
                                            </div>
                                        </div>
                                        <div class="card-body pt-1"><p class="mb-0"></p></div>
                                    </b-card>
                                    <!--                                //end comp-->
                                </b-colxx>
                            </b-row>
                            <div v-else class="loading" key="itemLoading"></div>
                        </b-colxx>
                        <!--    </b-row>-->
                        <v-contextmenu ref="contextmenu" @contextmenu="handleContextmenu">
<!--                            <v-contextmenu-item @click="onContextCopy()"><i class="simple-icon-docs"/> <span>Copy</span>-->
<!--                            </v-contextmenu-item>-->
<!--                            <v-contextmenu-item @click="onContextArchive()"><i class="simple-icon-drawer"/> <span>Move to archive</span>-->
<!--                            </v-contextmenu-item>-->
<!--                            <v-contextmenu-item @click="onContextDelete()"><i class="simple-icon-trash"/>-->
<!--                                <span>Delete</span></v-contextmenu-item>-->
                        </v-contextmenu>

                        <!-- Buttons -->
                        <b-colxx xs="12">
                            <b-form-group :label="$t('palletlabel.create.actions.title')" label-align="right">
                                <div class="d-flex justify-content-end">
                                    <b-button
                                        type="button"
                                        variant="outline-danger"
                                        class="ml-1"
                                        @click="clear"
                                    >{{ $t('palletlabel.create.actions.buttonClear') }}
                                    </b-button>
                                    <b-button
                                        type="submit"
                                        variant="primary"
                                        class="ml-1"
                                        :disabled="invalid"
                                    >{{ $t('shippinglabel.create.actions.buttonCreate') }}
                                    </b-button>
                                </div>
                            </b-form-group>

                        </b-colxx>
                    </div>

                </b-form>
            </validation-observer>
        </b-colxx>
    </b-row>
</template>

<script>
    export default {
        // TODO
        // Hier kan een vrachtbrief aangemaakt worden
        // trucker(user) kan meerdere vrachtwagens hebben
        //
        //
        //Tidy up file after done with todo list
        //Insert (module/controller)
        //Driver auto select truck
        name: "ShippinglabelCreate.vue",
        updated() {
            // $(this.$refs.selectTrucker).selectpicker('refresh');
            // $(this.$refs.selectLicense).selectpicker('refresh');
        },
        data() {
            return {
                loadingPDF: false,
                selectedColor: '',
                form: {
                    palletLabels: [],
                    deliveryDate: '',
                    trucker: {},
                    truck: {},
                },
                next: false,
                serverErrors: '',
                updateMode: false,
                selected: []
            }
        },
        computed: {
            palletLabels() {
                return this.$store.getters.palletLabels
            },
            // shippingLabelID() {
            //     // console.log('sadfasdfasd' + this.$store.getters.shippingLabels);
            //     return this.$store.getters.shippingLabels
            // },
            shippingLabel() {
                return this.$store.getters.shippingLabel
            },
            shippingLabelID() {
                return this.$store.getters.shippingLabelID
            },
            articles() {
                return this.$store.getters.articles
            },
            trucks() {
                // console.log(this.$store.getters.trucks);
                return this.$store.getters.trucks
            },
            truckers() {
                // console.log(this.$store.getters.truckers);
                return this.$store.getters.truckers
            },
            // selectAll: {
            //     get() {
            //         if (this.form.palletLabels && this.form.palletLabels.length > 0) { // A users array exists with at least one item
            //             let allChecked = true;
            //
            //             this.form.palletLabels.forEach((label) => {
            //                 if (!this.selected.includes(label.id)) {
            //                     allChecked = false; // If even one is not included in array
            //                 }
            //
            //                 // Break out of loop if mismatch already found
            //                 if (!allChecked) return;
            //             });
            //
            //             return allChecked;
            //         }
            //
            //         return false;
            //     },
            //     set(value) {
            //         const checked = [];
            //
            //         if (value) {
            //             this.palletLabels.forEach((label) => {
            //                 checked.push(label.id);
            //             });
            //         }
            //
            //         this.form.palletLabels = checked;
            //     }
            // },
        },
        mounted() {
            this.getAllPalletLabels();
            this.getAllArticles();
            this.getAllTrucks();
            this.getAllTruckers();
            this.getAllShippingLabels();
            this.form.deliveryDate = this.$moment().format('YYYY-MM-DD')
        },

        methods: {
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            selectTruck() {
                let filtered = this.trucks.find(trucks => trucks.userId === this.form.trucker.id);
                console.log(filtered);
                this.form.truck = filtered;

                this.next = true;
            },
            isSelectedAll() {
                return this.form.palletLabels.length >= this.palletLabels.length
            },
            isAnyItemSelected() {
                return this.form.palletLabels.length > 0 && this.form.palletLabels.length < this.palletLabels.length
            },
            // hideModal(refname) {
            //     this.$refs[refname].hide()
            // },
            // addNewItem() {
            //     const date = new Date()
            //     this.addTodoItem({
            //         title: this.newItem.title,
            //         detail: this.newItem.detail,
            //         category: this.newItem.category.value,
            //         label: this.newItem.label.value,
            //         status: this.newItem.status,
            //         date: date.getDay() + '.' + date.getMonth() + 1 + '.' + date.getFullYear(),
            //         labelColor: this.newItem.label.color
            //     })
            //     this.newItem = {
            //         title: '',
            //         category: '',
            //         detail: '',
            //         label: '',
            //         status: ''
            //     }
            //     this.hideModal('modalright')
            // },
            selectAll(isToggle) {
                if (this.form.palletLabels.length >= this.palletLabels.length) {
                    if (isToggle) {
                        this.form.palletLabels = []
                    }
                } else {
                    // this.form.palletLabels = this.palletLabels.map(x => x.id)
                    this.form.palletLabels = this.palletLabels
                }
            },
            keymap(event) {
                switch (event.srcKey) {
                    case 'select':
                        this.selectAll(false)
                        break
                    case 'undo':
                        this.form.palletLabels = []
                        break
                }
            },
            getIndex(value, arr, prop) {
                for (var i = 0; i < arr.length; i++) {
                    if (arr[i][prop] === value) {
                        return i
                    }
                }
                return -1
            },
            toggleItem(event, itemId) {
                if (event.shiftKey && this.form.palletLabels.length > 0) {
                    let itemsForToggle = this.palletLabels
                    var start = this.getIndex(itemId, itemsForToggle, 'id')
                    var end = this.getIndex(this.form.palletLabels[this.form.palletLabels.length - 1], itemsForToggle, 'id')
                    itemsForToggle = itemsForToggle.slice(Math.min(start, end), Math.max(start, end) + 1)
                    this.form.palletLabels.push(
                        ...itemsForToggle.map(item => {
                            return item
                        })
                    )
                } else {
                    if (this.form.palletLabels.includes(itemId)) {
                        this.form.palletLabels = this.form.palletLabels.filter(x => x !== itemId)
                    } else {
                        this.form.palletLabels.push(itemId)
                    }
                }
            },
            handleContextmenu(vnode) {
                if (!this.selected.includes(vnode.key)) {
                    this.selected = [vnode.key]
                }
            },
            onContextCopy() {
                //console.log('context menu item clicked - Copy Items: ', this.form.palletLabels)
            },
            onContextArchive() {
                //console.log('context menu item clicked - Move to Archive Items: ', this.form.palletLabels)
            },
            onContextDelete() {
                //console.log('context menu item clicked - Delete Items: ', this.form.palletLabels)
            },
            isLoading() {
                return false;
            },
            // clickList: function (palletLabel, index) {
            //     console.log(index);
            //     console.log(palletLabel.id);
            //     if(this.form.palletLabels[index]){
            //        // delete this.form.palletLabels[index];
            //         this.form.palletLabels.slice(index, index)
            //     }else {
            //         this.form.palletLabels[index] = palletLabel.id;
            //     }
            // },
            createShippingLabel() {
                this.$store.dispatch("createShippingLabel", this.form)
            },
            updateShippingLabel() {
                // console.log(this.form);
                this.$store.dispatch("updateShippingLabel", this.form)
            },
            updatePalletLabelStatus() {
                // console.log(this.form);
                this.$store.dispatch("updatePalletLabelStatus", this.form.palletLabels)
            },
            createShippingPalletID() {
                this.$store.dispatch("createShippingPalletID", this.form)
            },
            getArticleById(id) {
                return this.$store.getters.articleById(id)
            },
            getAllPalletLabels() {
                this.$store.dispatch("getAllPalletLabels");
            },
            getAllShippingLabels() {
                this.$store.dispatch("getAllShippingLabels").then(() => {
                    // this.form.palletLabels = this.palletLabels;
                });
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            getAllTrucks() {
                this.$store.dispatch("getAllTrucks");
            },
            getAllTruckers() {
                this.$store.dispatch("getAllTruckers");
            },
            clear() {
                this.form.palletLabels = [],
                    this.form.deliveryDate = '',
                    this.form.trucker = [],
                    this.form.truck = []
            },
            validateBeforeSubmit() {
                // console.log(this.loadingPDF);
                this.loadingPDF = true;
                // console.log(this.loadingPDF);

                this.updatePalletLabelStatus();
                // this.createShippingLabel();
                this.$store.dispatch("createShippingLabel", this.form)
                    .then(() => {
                        this.loadingPDF = false;
                        // console.log(this.loadingPDF);
                        this.$router.push({
                            name: 'shippinglabelPdf',
                            params: {id: this.shippingLabel.id}
                        })
                    });
            },
        }
    }
</script>
<style>
    .loading {
        display: inline-block !important;
        width: 30px !important;
        height: 30px !important;
        border-radius: 50% !important;
        animation: spin 1s ease-in-out infinite !important;
        -webkit-animation: spin 1s ease-in-out infinite !important;
        position: absolute !important;
        z-index: 1 !important;
    }

    .form-control[readonly] {
        background-color: transparent !important;
        opacity: 1 !important;
    }

    .noselect {
        -webkit-touch-callout: none; /* iOS Safari */
        -webkit-user-select: none; /* Safari */
        -khtml-user-select: none; /* Konqueror HTML */
        -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
        user-select: none;
        /* Non-prefixed version, currently
                                         supported by Chrome, Opera and Firefox */
    }

    input[type=checkbox] + palletlabelSelectStyling {
        /*color: #ccc;*/
        /*font-style: italic;*/
    }

    input[type=checkbox]:checked + palletlabelSelectStyling {
        color: white;
        font-weight: bold;
        font-style: normal;
        background-color: #f2ab59;
        border-color: #f2ab59;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #f2ab59;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #f2ab59;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
