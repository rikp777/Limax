<template>
    <b-card :title="$t('production.dashboard.title')" v-bind:class="[!valid ? 'bg-danger text-white' : 'bg-success text-dark']">
        <weight-check @valid="changeBackground"></weight-check>
    </b-card>
</template>
<script>
    import WeightCheck from "../../../components/crudl/weight/WeightCheck";
    export default {
        name: 'WeightDashboard',
        components: {
            WeightCheck
        },
        data() {
            return {
                valid: null,
            }
        },
        methods: {
            changeBackground(boolean){
                this.valid = boolean
            }
        }
    }
</script>
