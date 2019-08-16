<template>
    <div class="card">

        <div class="card-body">
            <h3 class="card-title">create</h3>
            <form class="form">
                <b-form-group label="Upload file" label-for="input8">
                    <b-form-file v-model="file" id="file" :state="Boolean(file)" placeholder="Choose a file..." @change="loadCSV($event)"></b-form-file>
                </b-form-group>
                <b-button type="submit" variant="success" class="mr-2">Submit</b-button>
                <b-button variant="light">Cancel</b-button>
            </form>
            <template v-if="parse_csv">
                <div id="printMe" v-on:click="checkPrint">
                    <div class="mt-4" v-for="group, groupName in groups">
                        <h6 class="mb-3" style="font-size: 26px;"><strong>{{groupName}}</strong></h6>
                        <div class="card-columns">
                            <div class="card" v-for="item in group">
                                <!--                                                    <img src="http://limaxaanvoer.limax.nl/storage/logo.png" class="card-img-top" alt="">-->
                                <div class="card-body">
                                    <h4 class="card-title">{{item['Omschrijving']}}</h4>
                                    <p class="card-text">
                                        LvH: {{item['LvH']}}<br>
                                        Punnet type: {{item['Punnet type']}}<br>
                                        Container box: {{item['CONTAINER BOX']}}<br>
                                        Price (/box): €{{item['Price (/box)']}}<br>
                                        Amount $ per pallet: {{item['Amount (container box) per Pallet / Europallet \r']}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                 </div>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Create",
        data () {
            return {
                file: null,
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
            checkPrint() {
                this.$htmlToPaper('printMe');
            },
            groupBy: function(array, keys){
                const result = {};
                array.forEach(item => {
                    const key = keys.map(k => item[k]).join(' > ');
                    if (!result[key]){
                        result[key] = []
                    }
                    result[key].push(item)
                });
                console.log(result);
                return result
            },
            csvJSON(csv){
                let vm = this;
                let lines = csv.split("\n");
                let result = [];
                let headers = lines[0].split(";");
                vm.parse_header = lines[0].split(";");
                lines[0].split(";").forEach(function (key) {
                    vm.sortOrders[key] = 1
                });
                lines.map(function(line, indexLine){
                    if (indexLine < 1) return; // Jump header line
                    let obj = {};
                    let currentline = line.split(";");
                    headers.map(function(header, indexHeader){
                        obj[header] = currentline[indexHeader]
                    });
                    result.push(obj)
                });
                result.pop(); // remove the last item because undefined values
                return result // JavaScript object
            },
            loadCSV(e) {
                let vm = this;
                if (window.FileReader) {
                    let reader = new FileReader();
                    reader.readAsText(e.target.files[0]);
                    // Handle errors load
                    reader.onload = function(event) {
                        let csv = event.target.result;
                        vm.parse_csv = vm.csvJSON(csv)
                    };
                    reader.onerror = function(evt) {
                        if(evt.target.error.name == "NotReadableError") {
                            alert("Can't read file !");
                        }
                    };
                } else {
                    alert('FileReader is not supported in this browser.');
                }
            }
        },
        computed: {
            groups() {
                let testKeys = ['Class', 'Soort', 'Sortering'];
                return this.groupBy(this.parse_csv, testKeys);
            },
        }
    }
</script>

<style scoped>

</style>
