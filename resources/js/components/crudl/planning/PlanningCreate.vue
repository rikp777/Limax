<template>
    <div>
        <b-row>
            <b-colxx xl="12" lg="12">
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
        <div class="separator mb-5"></div>
        <b-row>
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

                        <!--                        <b-dropdown id="ddown1" :text="" variant="outline-primary">-->
                        <!--                            <b-dropdown-item v-for="(cell,index) in cells" :key="index" @click="constructListOfIntervals($moment().subtract(4, 'days').format('YYYY-MM-DD'), $moment().add(7, 'days').format('YYYY-MM-DD'), 'day')">{{ cell.number + ' - ' + cell.description }}</b-dropdown-item>-->
                        <!--                        </b-dropdown>-->
                    </b-card-header>
                    <b-card-body>
                        <b-row>
                            <b-colxx>
                                <div><!-- throw away div for all the comment blocks -->
                                <!--                            <b-form inline>-->
                                <!--                                <b-colxx xxs="6">-->
                                <!--                                    <b-card class="mb-4" :title="$t('table.bootstrap-responsive')">-->
                                <!--                                        <b-table responsive :items="items" :fields="fields" />-->
                                <!--                                    </b-card>-->
                                <!--                                </b-colxx>-->
                                <!--                                <b-form-group v-for="interval in intervals" label-cols="2" horizontal :label="interval">-->
                                <!--                                    <b-input-group>-->
                                <!--                                        <b-form-input placeholder="placeholder" class="mb-2 mr-sm-2 mb-sm-2" />-->
                                <!--                                        <b-form-input placeholder="placeholder" class="mb-2 mr-sm-2 mb-sm-2" />-->
                                <!--                                        <b-form-input placeholder="placeholder" class="mb-2 mr-sm-2 mb-sm-2" />-->
                                <!--                                        <b-form-input placeholder="placeholder" class="mb-2 mr-sm-2 mb-sm-2" />-->
                                <!--                                        <b-form-input placeholder="status" class="mb-2 mr-sm-2 mb-sm-2" />-->
                                <!--                                    </b-input-group>-->

                                <!--                                </b-form-group>-->
                                <!--                            </b-form>-->


                                <!--                                <b-form>-->
                                <!--                                    <b-form-row v-for="(interval, key, index) in intervals">-->
                                <!--                                        <b-col>-->
                                <!--                                            <b-form-input readonly class="mb-2 mr-sm-2 mb-sm-2" :value="key"-->
                                <!--                                                          :disabled="index < 3" style="border-style: hidden"/>-->
                                <!--                                        </b-col>-->

                                <!--                                        <b-col v-for="sort in sorts">-->
                                <!--                                            <b-input-group :prepend="sort" class="mb-2 mr-sm-2 mb-sm-2">-->
                                <!--                                                <b-form-input type="number" class="mb-2 mr-sm-2 mb-sm-0"-->
                                <!--                                                              :value="interval"-->
                                <!--                                                              @blur="updatePlanning(sort, key, $event)"-->
                                <!--                                                              :disabled="index < 3"/>-->
                                <!--                                            </b-input-group>-->
                                <!--                                        </b-col>-->

                                <!--                                        <b-col>-->
                                <!--                                            <b-dropdown id="cell" class="ml-2" size="sm" variant="outline-primary"-->
                                <!--                                                        :disabled="index < 3">-->
                                <!--                                                <template slot="button-content">-->
                                <!--                                                    <span class="name">Prognose</span>-->
                                <!--                                                </template>-->
                                <!--                                                <b-dropdown-item>Prognose</b-dropdown-item>-->
                                <!--                                                <b-dropdown-item>Definitief</b-dropdown-item>-->
                                <!--                                            </b-dropdown>-->
                                <!--                                        </b-col>-->

                                <!--                                    </b-form-row>-->
                                <!--                                    <div v-for="(planning, key) in planning.planning"><br>-->

                                <!--                                    <div v-for="(plan, key) in planning">date = {{key}}-->

                                <!--                                    <div v-for="(sort, key) in plan">sortid = {{key}}-->

                                <!--                                    <div v-for="data in sort">amount = {{data.amount}} <hr></div>-->
                                <!--                                    </div>-->
                                <!--                                    </div>-->
                                <!--                                    </div>-->
                                <!--                                </b-form>-->

                                <!--                                27-02-2020 last working version-->
                                                                <b-form v-if="planningArr">
                                                                    <div >
                                <!--                                        {{key}}-->
                                                                    <b-form-row v-for="(planning, key, index) in planningArr">
                                                                        <b-col>
                                                                            <b-form-input readonly class="mb-2 mr-sm-2 mb-sm-2" :value="key.replace(/_/g, `-`).slice(0, 10)"
                                                                                          :disabled="index < 3" style="border-style: hidden"/>
                                                                        </b-col>
                                                                        <b-col v-for="(sort, key2) in planning">
                                                                            <b-input-group :prepend="key2" class="mb-2 mr-sm-2 mb-sm-2">
                                                                                <b-form-input v-if="sort" type="number" class="mb-2 mr-sm-2 mb-sm-0"
                                                                                              :value="sort"
                                                                                              @blur="updatePlanning(key2, key, $event)"
                                                                                              :disabled="index < 3"/>
                                                                                <b-form-input v-else type="number" class="mb-2 mr-sm-2 mb-sm-0"
                                                                                              value=""
                                                                                              @blur="updatePlanning(key2, key, $event)"
                                                                                              :disabled="index < 3"/>
                                                                            </b-input-group>
                                                                        </b-col>
<!--                                                                        <b-col>-->
<!--                                                                            <b-dropdown id="cell" class="ml-2" size="sm" variant="outline-primary"-->
<!--                                                                                        :disabled="index < 3">-->
<!--                                                                                <template slot="button-content">-->
<!--                                                                                    <span class="name">Prognose</span>-->
<!--                                                                                </template>-->
<!--                                                                                <b-dropdown-item>Prognose</b-dropdown-item>-->
<!--                                                                                <b-dropdown-item>Definitief</b-dropdown-item>-->
<!--                                                                            </b-dropdown>-->
<!--                                                                        </b-col>-->

                                                                    </b-form-row>
                                                                    </div>
                                <!--&lt;!&ndash;                                    <div v-for="(planning, key) in planning.planning"><br>&ndash;&gt;-->

                                <!--&lt;!&ndash;                                        <div v-for="(plan, key) in planning">date = {{key}}&ndash;&gt;-->

                                <!--&lt;!&ndash;                                            <div v-for="(sort, key) in plan">sortid = {{key}}&ndash;&gt;-->

                                <!--&lt;!&ndash;                                                <div v-for="data in sort">amount = {{data.amount}} <hr></div>&ndash;&gt;-->
                                <!--&lt;!&ndash;                                            </div>&ndash;&gt;-->
                                <!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
                                <!--&lt;!&ndash;                                    </div>&ndash;&gt;-->
                                                                </b-form>
                                <!--27-02-2020 last working version-->
                                </div><!-- throw away div for all the comment blocks -->
<!--                                <table id="planningTable">-->
<!--                                    <thead>-->
<!--                                    <tr>-->
<!--                                        <th></th>-->
<!--                                        <th v-for="(sorts, key, index) in planning.sorts">{{sorts.name}}</th>-->
<!--                                    </tr>-->
<!--                                    </thead>-->
<!--                                    <tbody>-->
<!--                                    <tr v-for="(dates, key, index) in planning.datesInterval">-->
<!--                                        <td>{{ $moment(dates).format('YYYY-MM-DD') }}</td>-->
<!--                                        <td v-for="(amount, key, index) in planning.planning"></td>-->
<!--                                    </tr>-->
<!--                                    </tbody>-->
<!--                                </table>-->
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
    import {mapGetters} from "vuex";

    export default {
        name: "PlanningCreate",
        components: {},
        data() {
            return {
                planningArr: null,
                // items: [],
                cell: null,
                // sortTest: ['fijn', 'giant', 'industrie', 'groot', 'total'],
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
            getAllArticleFarmers() {
                this.$store.dispatch("getAllArticleFarmers");
            },
            getAllCells() {
                this.$store.dispatch("getAllCells");
            },
            CellPlanning(cell) {
                // console.log(cell);
                this.cell = cell;
            },
            loadPlanning(id) {
                Promise.all([
                    this.$store.dispatch("getPlanning", this.authFarmer.id).then((response) => {
                        console.log('hiernaar planning console loggen')
                    })
                ]).finally(() => {
                    // console.log(this.planning.planning)
                    // console.log(id.id)
                    // console.log(this.planning.planning[id.id])
                    this.planningArr = this.planning.planning[id.id];
                });
            },
            updatePlanning(sort, interval, e) {
                //if has value, do update
                //if no value (so misclick on cell) dont do anything
                if (e.target.value) {
                    console.log('sortering : ' + sort);
                    console.log('date : ' + interval);
                    console.log('cell : ' + this.cell.description);
                    console.log('value : ' + e.target.value);

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
                    this.loadPlanning(this.cell)
                } else {
                    console.log('value = empty');
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
                    console.log(this.intervals)
                })

            }
            // constructListOfIntervals(start, end, interval, cell) {
            //     Promise.all([
            //         this.intervals = null,
            //         this.CellPlanning(cell),
            //         this.loadPlanning()
            //     ]).finally(() => {
            //         let intervals = {};
            //         let intervalsAll = {};
            //         const diffUnitOfTime = `${interval}`;
            //
            //         while (this.$moment(end).diff(start, diffUnitOfTime) > 0) {
            //             const currentEnd = this.$moment(this.$moment(start).add(1, diffUnitOfTime)).format('YYYY-MM-DD');
            //
            //             for (const key in this.planning.planning) {
            //                 if (this.$moment(this.planning.planning[key].date).format('YYYY-MM-DD') === currentEnd) {
            //                     if (this.planning.planning[key].cellId === this.cell.id) {
            //                         console.log('date =')
            //                         console.log(this.$moment(this.planning.planning[key].date).format('YYYY-MM-DD'))
            //                         console.log('currentEnd =')
            //                         console.log(currentEnd)
            //                         console.log('amount =')
            //                         console.log(this.planning.planning[key].planningAmount[0].sortTypeId)
            //                         console.log(this.planning.planning[key].planningAmount[0].amount)
            //                         console.log('===================')
            //                         Object.assign(intervals, {[currentEnd]: this.planning.planning[key].planningAmount[0].amount});
            //                     }
            //                 }
            //             }
            //             Object.assign(intervalsAll, {[currentEnd]: 0});
            //             start = currentEnd;
            //         }
            //         let finalGrouped = {...intervalsAll, ...intervals}
            //         this.intervals = finalGrouped;
            //     })
            //
            // }
        },
        mounted() {
            Promise.all([
                // this.$store.dispatch("getPlanning", this.authFarmer.id).then((response) => {}),
                this.getAllCells(),
                this.$store.dispatch("getAllArticleFarmers").then((response) => {
                    console.log("nu ben ik klaar")
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
                console.log(SortdataArr)


                for (const key in this.articlefarmers) {
                    if (!GroupdataArr.includes(this.articlefarmers[key].articleGroup.name)) {
                        // GroupdataArr.push(
                        this.articlegroup = this.articlefarmers[key].articleGroup.name
                        // );
                    }
                }
                // this.articlegroup = GroupdataArr;
                // console.log(GroupdataArr)
            })
        },
    }
</script>

<style scoped>

</style>
