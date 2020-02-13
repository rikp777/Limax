<template>
    <b-row>
        <b-colxx xl="12" lg="12" class="mb-4">
            <b-card :title="$t('report.title') + ' ' + authFarmer.name + ' : ' + $moment().locale('nl').format('L')" style="border-left: 6px solid #f28125">
            <report-read />
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    import reportCreate from "../../../components/crudl/report/reportCreate";
    import reportUpdate from "../../../components/crudl/report/reportUpdate";
    import reportList from "../../../components/crudl/report/reportList";
    import reportRead from "../../../components/crudl/report/reportRead";
    import {mapGetters} from "vuex";

    export default {
        data () {
            return {
                update: false,
                userId: null
            }
        },
        components: {
            reportCreate,
            reportUpdate,
            reportList,
            reportRead
        },
        methods: {
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
