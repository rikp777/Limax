<template>
    <div class="row">
        <div class="card">
            <form class="needs-validation" @submit.prevent="validateBeforeSubmit">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="col mb-3">
<!--                                <div class="card border-0 text-white mb-3" style="background-color: #313c6a">-->
                                <div class="card border-0 text-black mb-3">
                                    <div class="row">
<!--                                        <div class="col-12">-->
<!--                                            <h6 class="card-header border-bottom-0" v-if="delMode === false"><button type="button" class="btn btn-primary text-white float-right" style="width: 100%;" @click="delMode = true" v-if="delMode === false"><b>Cell Creation Mode</b></button></h6>-->
<!--                                            <h6 class="card-header border-bottom-0" v-if="delMode === true"><button type="button" class="btn btn-primary text-white float-right" style="width: 100%;" @click="delMode = false" v-if="delMode === true"><b>Cell Remove Mode</b></button></h6>-->
<!--                                        </div>-->
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-3" v-for="(cell, index) in form.cells" >
                                                <label class="active">{{cell.number}}</label>
                                                <input type="text" class="form-control" style="border-color: red" v-if="delMode === true" v-model="form.cells[index].description" @blur="cellUpdate(cell)">
                                                <input type="text" class="form-control" style="border-color: green" v-if="delMode === false" v-model="form.cells[index].description" @blur="cellUpdate(cell)">
                                                <!--                                        <input type="text" class="form-control" v-model="form.cells[index].description" v-on:change="btnShow = true">-->
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="active"><span style="opacity:0;">Add Cell</span></label>
                                                <button type="button" class="btn btn-primary text-white"  style="width: 100%;" @click="addRow" v-if="delMode === false"><b>+</b></button>
                                                <button type="button" class="btn btn-primary text-white"  style="width: 100%;" v-if="delMode === true"><b>-</b></button>
                                            </div>
                                        </div>
                                        <!--                                <button type="button" class="btn btn-primary text-white" v-if="btnShow === true" @click="validateBeforeSubmit">Print</button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex';
    import {getToken} from '../../common/jwt.service';
    export default {
        name: "profile-update",
        data() {
            return {
                form: {
                    cells: [],
                },
                delMode: false,
                btnShow: '',
                isChecked: '',
                serverErrors: '',
                updateMode: false,
            }
        },
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"]),
            farmer(){
                return this.$store.getters.farmer;
            },
            cells(){
                return this.$store.getters.cells;
            },
            cell(){
                return this.$store.getters.cell;
            },
        },
        mounted() {
          this.getFarmer(getToken('farmer'));
          this.getAllCells();
        },
        methods: {
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            },
            getAllCells() {
                this.$store.dispatch("getAllCells")
                    .then(()=>{
                        console.log(this.cells);
                        this.form.cells = this.cells;
                    });
            },
            // createCell(){
            //     this.$store.dispatch("createCell")
            //         .then(()=>{
            //             console.log('hoi');
            //             console.log(this.cell);
            //             // this.form.cells.push(this.cell);
            //         }).catch(()=>{
            //             console.log('hoi');
            //     })
            // },
            updateCell(){
                this.$store.dispatch("updateCell", this.form)
            },
            addRow: function() {
                this.$store.dispatch("createCell")
                    .then(()=> {
                        // console.log(this.cell),
                        this.cells.push({
                            createdAt: this.cell.createdAt,
                            description: "",
                            farmerId: getToken('farmer'),
                            id: this.cell.id,
                            number: this.cell.number,
                            updatedAt: '',
                        });
                    });
            },
            delRow: function() {
                this.$store.dispatch("deleteCell")
                    .then(()=> {
                        // this.cells.push({
                        //     createdAt: this.cell.createdAt,
                        //     description: "",
                        //     farmerId: getToken('farmer'),
                        //     id: this.cell.id,
                        //     number: this.cell.number,
                        //     updatedAt: '',
                        // });
                    });
            },
            cellUpdate(cell) {
                this.$store.dispatch("updateCell", cell);
                console.log(cell);
            },
        }
    }
</script>

<style scoped>

</style>
