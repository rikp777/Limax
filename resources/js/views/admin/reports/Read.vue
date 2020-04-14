<template>
    <b-row>
        <b-colxx xl="12" lg="12" class="mb-4">
            <b-card :title="$t('report.title') + ' ' + authFarmer.name + ' : ' + $moment().locale('nl').format('L')" style="border-left: 6px solid #f28125">
                <b-refresh-button @click="refreshButtonClick"/>
                <report-read :key="refresh" />
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    import reportCreate from "../../../components/crudl/report/ReportCreate";
    import reportUpdate from "../../../components/crudl/report/ReportUpdate";
    import reportList from "../../../components/crudl/report/ReportList";
    import reportRead from "../../../components/crudl/report/ReportRead";
    import {mapGetters} from "vuex";

    export default {
        data () {
            return {
                update: false,
                userId: null,
                refresh: null
            }
        },
        components: {
            reportCreate,
            reportUpdate,
            reportList,
            reportRead
        },
        methods: {
            refreshButtonClick() {
                this.refresh += 1;
            }
        },
        computed: {
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
            }),
        }
    }
</script>

<style scoped>

</style>
