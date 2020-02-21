<template>
    <b-row>
        <b-colxx xl="12" lg="12" class="mb-4">
            <b-card :title="$t('planning.create.title') + ' - ' + authFarmer.name"
                    style="border-left: 6px solid #f28125">
                <div v-if="!update">
                    <planning-create/>
                </div>
<!--                <div v-else>-->
<!--                    <planning-update/>-->
<!--                </div>-->
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    import planningCreate from "../../../components/crudl/planning/PlanningCreate";
    import {mapGetters} from "vuex";
    // import planningUpdate from "../../../components/crudl/user/planningUpdate";

    export default {
        data() {
            return {
                update: false,
                userId: null
            }
        },
        components: {
            planningCreate,
            // planningUpdate,
        },
        computed: {
            ...mapGetters({
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
            }),
        },
        methods: {
            updateListener(id) {
                console.log('update: ' + id)
                this.userId = id
                this.update = true
            },
            createListener() {
                console.log('create')
                this.update = false
            }
        }
    }
</script>

<style scoped>

</style>
