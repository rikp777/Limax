<template>
    <div>
        <b-row>
            <b-colxx md="12" class="mb-4" v-if="setupItems.length">
                <b-card title="alerts">
                    <b-refresh-button/>
                    <vue-perfect-scrollbar class="scroll dashboard-list-with-user"
                                           :settings="{ suppressScrollX: true, wheelPropagation: false }">
                        <list-with-palletlabel-setup-item v-for="(item, index) in setupItems" :data="item" :key="index"/>
                    </vue-perfect-scrollbar>
                </b-card>
            </b-colxx>
            <b-colxx xl="12" lg="12" v-if="!setupItems.length">
                <div class="icon-cards-row">
                    <div data-glide-el="track" class="glide__track">
                        <div class="glide__slides">
                            <div class="icon-row-item">
                                <!--                                <b-card class="mb-4 text-center">-->
                                <!--                                    <i class="iconsminds-clock"/>-->
                                <!--                                    <p class="card-text font-weight-semibold mb-0">Article Group</p>-->
                                <!--                                    <p class="lead text-center">{{articlegroup}}</p>-->
                                <!--                                </b-card>-->
                            </div>
                        </div>
                    </div>
                </div>
            </b-colxx>
            <!--            <b-colxx xl="3" lg="6">-->
            <!--                <div class="icon-cards-row">-->
            <!--                    <div data-glide-el="track" class="glide__track">-->
            <!--                        <div class="glide__slides">-->
            <!--                            <div class="icon-row-item">-->
            <!--                                <b-card class="mb-4 text-center">-->
            <!--                                    <i class="iconsminds-basket-coins"/>-->
            <!--                                    <p class="card-text font-weight-semibold mb-0">Completed Orders</p>-->
            <!--                                    <p class="lead text-center">32</p>-->
            <!--                                </b-card>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </b-colxx>-->
            <!--            <b-colxx xl="3" lg="6">-->
            <!--                <div class="icon-cards-row">-->
            <!--                    <div data-glide-el="track" class="glide__track">-->
            <!--                        <div class="glide__slides">-->
            <!--                            <div class="icon-row-item">-->
            <!--                                <b-card class="mb-4 text-center">-->
            <!--                                    <i class="iconsminds-arrow-refresh"/>-->
            <!--                                    <p class="card-text font-weight-semibold mb-0">Refund Requests</p>-->
            <!--                                    <p class="lead text-center">74</p>-->
            <!--                                </b-card>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </b-colxx>-->
            <!--            <b-colxx xl="3" lg="6">-->
            <!--                <div class="icon-cards-row">-->
            <!--                    <div data-glide-el="track" class="glide__track">-->
            <!--                        <div class="glide__slides">-->
            <!--                            <div class="icon-row-item">-->
            <!--                                <b-card class="mb-4 text-center">-->
            <!--                                    <i class="iconsminds-mail-read"/>-->
            <!--                                    <p class="card-text font-weight-semibold mb-0">New Comments</p>-->
            <!--                                    <p class="lead text-center">25</p>-->
            <!--                                </b-card>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </b-colxx>-->
        </b-row>
<!--        <div class="separator mb-5" v-if="!setupItems.length"></div>-->
        <b-row v-if="!setupItems.length">
            <b-colxx xl="12" lg="12" md="12" class="mb-4">
                <b-card>
                    <b-card-header>

                        <b-dropdown id="cell" class="ml-2" size="sm" variant="outline-primary" block>
                            <template slot="button-content">
                                <span class="name" v-if="cell">{{ cell.number + ' - ' + cell.description }}</span>
                                <span class="name" v-else>Select Cell</span>
                            </template>
                            <b-dropdown-item v-for="(cell,index) in cells" :key="index" v-bind="cell"
                                             @click="constructListOfIntervals($moment().subtract(4, 'days').format('YYYY-MM-DD'), $moment().add(7, 'days').format('YYYY-MM-DD'), 'day', cell)">
                                {{ cell.number + ' - ' + cell.description }}
                            </b-dropdown-item>
                        </b-dropdown>

                        <br v-if="!isLoad"><br v-if="!isLoad"><br v-if="!isLoad"><br v-if="!isLoad"><br v-if="!isLoad">
                        <div v-if="!isLoad" class="loading"></div>
                    </b-card-header>
                    <b-card-body>
                        <b-row align-v="center">
                            <b-colxx v-if="isLoad">
                                    <b-form v-if="planningArr">
                                        <b-form-row v-for="(planning, key, index) in planningArr" :key="index">
<!--                                        <b-form-row v-for="(planning, key, index) in planningArr" :key="index" v-bind:class="{'text-success' : switches[key] === true}">-->
                                            <b-colxx cols="auto">
                                                <b-form-input readonly
                                                              :value="key.replace(/_/g, `-`).slice(0, 10)"
                                                              style="border-style: hidden"/>
                                            </b-colxx>
                                            <b-col v-for="(sort, key2) in planning">
                                                <b-input-group :prepend="key2" class="mb-2 mr-sm-2 mb-sm-2">
                                                    <b-form-input v-if="sort" type="number" class="mb-2 mr-sm-2 mb-sm-0"
                                                                  :value="sort"
                                                                  @blur="updatePlanning(key2, key, $event)"
                                                                  :disabled="index < 3 || switches[key] === true" />
                                                    <b-form-input v-else type="number" class="mb-2 mr-sm-2 mb-sm-0"
                                                                  value=""
                                                                  @blur="updatePlanning(key2, key, $event)"
                                                                  :disabled="index < 3 || switches[key] === true" />
                                                </b-input-group>
                                            </b-col>

                                            <b-col class="mb-2 mr-sm-2 mb-sm-0" >
                                                <switches :disabled="index < 3" v-if="switches[key] === true" textDisabled="Prognose" textEnabled="Definitief" :emit-on-mount="false" disabled="true" v-model="switches[key]" theme="custom" color="primary"></switches>
                                                <switches :disabled="index < 3" v-else v-model="switches[key]" textDisabled="Prognose" textEnabled="Definitief" :emit-on-mount="false" @input="progToDef(key)" theme="custom" color="primary"></switches>
                                            </b-col>

                                        </b-form-row>

                                    </b-form>
                            </b-colxx>
                        </b-row>
                    </b-card-body>
                </b-card>
            </b-colxx>
        </b-row>
    </div>
</template>


<script>

    // TODO
    // change disabled style for today -3 days for darkmode. this does not work properly yet!

    import vSelect from "vue-select";
    import Vuetable from "vuetable-2/src/components/Vuetable";
    import ListWithPalletlabelSetupItem from "../../listing/ListWithPalletlabelSetupItem";
    import {mapGetters} from "vuex";
    import Switches from "vue-switches";

    export default {
        name: "PlanningCreate",
        components: {
            'switches': Switches,
            ListWithPalletlabelSetupItem,
        },
        data() {
            return {
                palletLabelLength: [],
                setupItems: [],
                switches: null,
                isLoad: false,
                planningArr: null,
                cell: null,
                sorts: null,
                articlegroup: null,
                intervals: null,
                disabledCount: 0,
            }
        },
        computed: {
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
                palletLabel: 'palletLabel',
            }),
            articlefarmers() {
                return this.$store.getters.articlefarmers;
            },
            cells() {
                return this.$store.getters.cells;
            },
            planning() {
                return this.$store.getters.planning;
            },
        },
        methods: {
            checkSetup() {
                // console.log(this.palletLabel);
                if (!this.palletLabelLength.length) {
                    let data = {
                        title: 'You need atleast 1 palletlabel made before you can start planning!',
                        description: 'In order to start planning you need to create atleast 1 palletlabel.',
                        linkPath: '/planner/planning/create'
                    };
                    this.setupItems.push(data);
                }
            },
            progToDef(date) {
                const cellDateKey = {
                    cell_id: this.cell.id,
                    date: date.replace(/_/g, `-`).slice(0, 10)
                };
                // console.log(this.cell.id + ' ' + date.replace(/_/g, `-`).slice(0, 10));
                this.$store.dispatch("updatePlanningStatus", cellDateKey)
            },
            getAllArticleFarmers() {
                this.$store.dispatch("getAllArticleFarmers");
            },
            getAllCells() {
                this.$store.dispatch("getAllCells");
            },
            CellPlanning(cell) {
                this.cell = cell;
            },
            loadPlanning(id) {
                this.isLoad = false
                Promise.all([
                    this.$store.dispatch("getPlanning", this.authFarmer.id).then((response) => {
                        //console.log('hiernaar planning console loggen')
                    })
                ]).finally(() => {
                    // console.log(this.planning.planning);
                    this.planningArr = this.planning.planning[id.id];
                    this.switches = this.planning.prognose[id.id];
                    // console.log(this.switches);
                    this.isLoad = true
                });
            },
            updatePlanning(sort, interval, e) {
                //if has value, do update
                //if no value (so misclick on cell) dont do anything
                if (e.target.value) {
                    //console.log('sortering : ' + sort);
                    //console.log('date : ' + interval);
                    //console.log('cell : ' + this.cell.description);
                    //console.log('value : ' + e.target.value);

                    const planningArr = {
                        cell: this.cell,
                        sort: sort,
                        date: interval,
                        amount: e.target.value
                    };

                    this.$store.dispatch("createPlanning", planningArr)
                        .then(() => {
                            // this.$swal({
                            //     position: 'top-end',
                            //     icon: 'success',
                            //     showConfirmButton: false,
                            //     timer: 300
                            // });
                        });
                    // this.loadPlanning(this.cell)
                } else {
                    //console.log('value = empty');
                }


            },
            constructListOfIntervals(start, end, interval, cell) {
                Promise.all([
                    this.intervals = null,
                    this.CellPlanning(cell),
                    this.loadPlanning(cell)
                ]).finally(() => {
                    let intervals = {};
                    let intervalsAll = {};
                    const diffUnitOfTime = `${interval}`;

                    while (this.$moment(end).diff(start, diffUnitOfTime) > 0) {
                        const currentEnd = this.$moment(this.$moment(start).add(1, diffUnitOfTime)).format('YYYY-MM-DD');

                        for (const key in this.planning.planning) {
                            if (this.$moment(this.planning.planning[key].date).format('YYYY-MM-DD') === currentEnd) {
                                if (this.planning.planning[key].cellId === this.cell.id) {
                                    Object.assign(intervals, {[currentEnd]: this.planning.planning[key].amount});
                                }
                            }
                        }
                        Object.assign(intervalsAll, {[currentEnd]: 0});
                        start = currentEnd;
                    }
                    let finalGrouped = {...intervalsAll, ...intervals}
                    this.intervals = finalGrouped;
                    //console.log(this.intervals)
                })

            },
            getAllPalletLabels() {
                this.$store.dispatch("getAllPalletLabels").then(()=> {
                    // if (this.palletLabel){}
                    this.palletLabelLength.push(this.palletLabel);
                    console.log(this.palletLabel);
                    console.log(this.palletLabelLength);
                });
            }
        },
        mounted() {
            Promise.all([
                this.getAllCells(),
                this.getAllPalletLabels(),
                this.$store.dispatch("getAllArticleFarmers").then((response) => {
                    //console.log("nu ben ik klaar")
                })
            ]).finally(() => {
                const SortdataArr = [];
                const GroupdataArr = [];
                for (const key in this.articlefarmers) {
                    if (!SortdataArr.includes(this.articlefarmers[key].sortType.name)) {
                        SortdataArr.push(
                            this.articlefarmers[key].sortType.name
                        );
                    }
                }
                this.sorts = SortdataArr;
                //console.log(SortdataArr)


                for (const key in this.articlefarmers) {
                    if (!GroupdataArr.includes(this.articlefarmers[key].articleGroup.name)) {
                        this.articlegroup = this.articlefarmers[key].articleGroup.name
                    }
                }
                this.checkSetup();
            })
        },
    }
</script>

<style scoped>
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
</style>
