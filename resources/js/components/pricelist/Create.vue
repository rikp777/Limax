<template>
    <div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">create</h3>

                <form class="form">
                    <b-form-group label="Upload file" label-for="input8">
                        <b-form-file v-model="file" id="file" :state="Boolean(file)" placeholder="Choose a file..." @change="convertFile($event)"></b-form-file>
                    </b-form-group>
                    <b-button type="submit" variant="success" class="mr-2">Submit</b-button>
                    <b-button variant="light">Cancel</b-button>
                </form>
            </div>
        </div>
        <template v-if="remap.class.length">
            <hr>
            <div id="printMe" v-on:click="checkPrint">
                <div class="text-center">
                    <img class="card-img-top" style="width: 400px; height: auto; margin-bottom: 20px" src='https://www.limax.nl/images/limax-logo@3x.png' alt="Card image cap">
                </div>

                <div class="row">
                    <div class="col-sm-5">
                        <strong>Pricelist: </strong>{{ moment().format("dddd, MMMM Do YYYY") }}
                    </div>
                </div>
                <hr>
                <div v-for="classData in remap.class">
                    <img class="w-100" src="https://www.limax.nl/build/images/color-bar.48031fde.svg">
                    <h1 class="mt-3"><strong>{{classData.name}}</strong></h1>
                    <div v-for="article_groupData in classData.article_group">
                        <img class="w-100" style="height: 3px" src="https://www.limax.nl/build/images/color-bar.48031fde.svg">
                        <h2 class="ml-2 mt-3"><strong>{{article_groupData.name}}</strong></h2>
                        <div v-for="extraData in article_groupData.extra">
                            <div v-for="extra in extraData">
                                <h3 class="ml-4"><strong>{{extra.name}}</strong></h3>
                                <div class="ml-4 card-columns">
                                    <div class="card border border-dark" v-for="data in extra.data">
                                        <img v-if="data.image" :src="data.image" class="card-img-top" >
                                        <div class="card-body">
                                            <h4 class="card-title">{{data.article_description}}</h4>
                                            <ul class="list-unstyled mt-3 mb-4">
                                                <li>{{data.amount}} per pallet</li>
                                            </ul>
                                            <h1 class="card-title pricing-card-title">€ {{data.price}}<small class="text-muted">/ box </small> </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    const Papa = require('papaparse');
    export default {
        name: "Create",
        data () {
            return {
                file: null,
                fileData: [],
            }
        },
        methods: {
            convertFile(e){
                this.file = null;
                this.fileData = [];
                let file = e.target.files[0];


                Papa.parsePromise = function(file) {
                    return new Promise(function(complete, error) {
                        Papa.parse(file, {
                            complete,
                            error,
                            header: true,
                            dynamicTyping: true,
                        });
                    });
                };

                Papa.parsePromise(file)
                    .then((results) => {
                        this.fileData = results.data.filter(x => x.display === 1);
                    });

            },

            checkPrint() {
                this.$htmlToPaper('printMe');
            },
        },
        computed: {
            remap(){
                let resultData = {'class': []};
                let classes = _(this.fileData)
                    .groupBy(x => x.class)
                    .map((value, key) => ({name: key, data: value}))
                    .value();

                //voor elke class
                classes.forEach((classs) => {
                    let classesData = {
                        "name" : classs.name,
                        "article_group": []
                    };

                    let articleGroups = _(classs.data)
                        .groupBy(x => x.article_group)
                        .map((value, key) => ({name: key, data: value}))
                        .value();
                    //voor elke articleGroup
                    articleGroups.forEach((articleGroup) => {
                        let articleGroupsData = {
                            "name": articleGroup.name,
                            "extra": []
                        };

                        let extras = _(articleGroup.data)
                            .groupBy(x => x.extra)
                            .map((value, key) => ({name: key, data: value}))
                            .value();

                        // extras.forEach((extra) => {
                        //     let extrasData = {
                        //         "name": extra.name,
                        //         "data": extra
                        //     };
                        //
                        //     let punnetTypes = _(extra.data)
                        //         .groupBy(x => x.punnet_type)
                        //         .map((value, key) => ({name: key, data: value}))
                        //         .value();
                        //
                        //     extrasData['punnet_type'].push(punnetTypes);
                            articleGroupsData['extra'].push(extras);
                        // });
                        classesData['article_group'].push(articleGroupsData);
                    });
                    // console.log(resultData);
                    resultData['class'].push(classesData);
                });
                resultData['class'] = resultData['class'].filter(value => value.name !== "undefined");
                resultData['class'] = resultData['class'].filter(value => value.name !== "null");
                // console.log(resultData);
                return resultData;
            }
        }
    }
</script>

<style scoped>

</style>
