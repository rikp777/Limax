<template>
    <b-card :title="$t('trucker.dashboard.title')">
        <shippinglabelscan></shippinglabelscan>
    </b-card>
</template>
<script>
    import shippinglabelscan from "../../../components/crudl/trucker/shippinglabelscan";
    export default {
        name: 'WeightDashboard',
        components: {
            shippinglabelscan
        },
        data() {
            return {
            }
        },
        methods: {
        }
    }
</script>
