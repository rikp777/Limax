<template>
    <b-row>
        <b-colxx xl="12" lg="12" class="mb-4">
            <b-card :title="$t('planning.overview.title') + ' - ' + authFarmer.name" style="border-left: 6px solid #f28125">
                <b-refresh-button @click="refreshButtonClick"/>
<!--            <planning-read :key="refresh" />-->
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    import planningCreate from "../../../components/crudl/planning/PlanningCreate";
    import planningUpdate from "../../../components/crudl/planning/PlanningUpdate";
    import planningList from "../../../components/crudl/planning/PlanningList";
    import planningRead from "../../../components/crudl/planning/PlanningRead";
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
            planningCreate,
            planningUpdate,
            planningList,
            planningRead
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
