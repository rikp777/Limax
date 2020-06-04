<template>
<!--    <b-card :title="$t('menu.planning.main')">-->
        <planning></planning>
<!--    </b-card>-->
</template>
<script>
    import planning from "../../../components/crudl/logistics/Planning";
    export default {
        name: 'Index',
        components: {
            planning
        },
        data() {
            return {
                // valid: null,
            }
        },
        methods: {
            // changeBackground(boolean){
            //     this.valid = boolean
            // }
        }
    }
</script>
