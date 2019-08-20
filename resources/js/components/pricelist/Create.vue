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
        <template v-if="remap.class">
            <div id="printMe" v-on:click="checkPrint">
                <div v-for="classData in remap.class">
                <h1><strong>{{classData.name}}</strong></h1>
                <div v-for="article_groupData in classData.article_group">
                    <h2 class="ml-2"><strong>{{article_groupData.name}}</strong></h2>
                    <div v-for="extraData in article_groupData.extra">
                        <div v-for="extra in extraData">
                            <h3 class="ml-4"><strong>{{extra.name}}</strong></h3>
                            <div class="ml-4 card-columns">
                                <div class="card border border-dark" v-for="data in extra.data">
                                    <img v-if="data.image" :src="data.image" class="card-img-top" >
                                    <div class="card-body">
                                        <h4 class="card-title">{{data.article_description}}</h4>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>{{data.trade_unit}}</li>
                                            <li>{{data.container_box}}</li>
                                            <li>{{data.amount}} per pallet</li>
                                        </ul>
                    <!--                    <p>8 x 150gr | Multi | 200 / 160 per pallet</p>-->
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


<!--    <div class="card">-->

<!--        <div class="card-body">-->
<!--            <h3 class="card-title">create</h3>-->

<!--            <form class="form">-->
<!--                <b-form-group label="Upload file" label-for="input8">-->
<!--                    <b-form-file v-model="file" id="file" :state="Boolean(file)" placeholder="Choose a file..." @change="convertFile($event)"></b-form-file>-->
<!--                </b-form-group>-->
<!--                <b-button type="submit" variant="success" class="mr-2">Submit</b-button>-->
<!--                <b-button variant="light">Cancel</b-button>-->
<!--            </form>-->
<!--            <template v-if="remap.class">-->
<!--                <div v-for="classData in remap.class">-->
<!--                    <h1><strong>{{classData.name}}</strong></h1>-->
<!--                    <div v-for="article_groupData in classData.article_group">-->
<!--                        <h2><strong>&#45;&#45;{{article_groupData.name}}</strong></h2>-->
<!--                        <div v-for="extraData in article_groupData.extra">-->
<!--                            <div v-for="extra in extraData">-->
<!--                                <h2><strong>&#45;&#45;&#45;&#45;{{extra.name}}</strong></h2>-->
<!--                                <div class="card-columns">-->
<!--                                        <div class="card" v-for="data in extra.data">-->
<!--                                            <div class="card-body">-->
<!--                                                <h5 class="card-title">{{data.article_description}}</h5>-->
<!--                                                <p class="card-text">{{data.price}}</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div id="printMe" v-on:click="checkPrint">-->
<!--&lt;!&ndash;                    <div class="mt-4" v-for="group, groupName in groups">&ndash;&gt;-->
<!--&lt;!&ndash;                        <h6 class="mb-3" style="font-size: 26px;"><strong>{{groupName}}</strong></h6>&ndash;&gt;-->
<!--&lt;!&ndash;                        <div class="card-columns">&ndash;&gt;-->
<!--&lt;!&ndash;                            <div class="card" v-for="item in group">&ndash;&gt;-->
<!--&lt;!&ndash;                                &lt;!&ndash;                                                    <img src="http://limaxaanvoer.limax.nl/storage/logo.png" class="card-img-top" alt="">&ndash;&gt;&ndash;&gt;-->
<!--&lt;!&ndash;                                <div class="card-body">&ndash;&gt;-->
<!--&lt;!&ndash;                                    <h4 class="card-title">{{item['Omschrijving']}}</h4>&ndash;&gt;-->
<!--&lt;!&ndash;                                    <p class="card-text">&ndash;&gt;-->
<!--&lt;!&ndash;                                        LvH: {{item['LvH']}}<br>&ndash;&gt;-->
<!--&lt;!&ndash;                                        Punnet type: {{item['Punnet type']}}<br>&ndash;&gt;-->
<!--&lt;!&ndash;                                        Container box: {{item['CONTAINER BOX']}}<br>&ndash;&gt;-->
<!--&lt;!&ndash;                                        Price (/box): €{{item['Price (/box)']}}<br>&ndash;&gt;-->
<!--&lt;!&ndash;                                        Amount $ per pallet: {{item['Amount (container box) per Pallet / Europallet \r']}}&ndash;&gt;-->
<!--&lt;!&ndash;                                    </p>&ndash;&gt;-->
<!--&lt;!&ndash;                                </div>&ndash;&gt;-->
<!--&lt;!&ndash;                            </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        </div>&ndash;&gt;-->
<!--&lt;!&ndash;                        <hr>&ndash;&gt;-->
<!--&lt;!&ndash;                    </div>&ndash;&gt;-->
<!--&lt;!&ndash;                 </div>&ndash;&gt;-->
<!--            </template>-->
<!--        </div>-->
<!--    </div>-->
</template>

<script>
    const Papa = require('papaparse');
    export default {
        name: "Create",
        data () {
            return {
                file: null,
                fileData: [],
                channel_name: '',
                channel_fields: [],
                channel_entries: [],
                parse_header: [],
                parse_csv: [],
                sortOrders:{},
                sortKey: ''
            }
        },
        methods: {
            convertFile(e){
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
                        this.fileData = results.data
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
                return resultData;
            }
        }
    }
</script>

<style scoped>

</style>
