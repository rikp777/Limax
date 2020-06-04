<template>
    <!--    <b-card :title="$t('menu.planning.main')">-->
    <transport></transport>
    <!--    </b-card>-->
</template>
<script>
    import transport from "../../../components/crudl/logistics/Transport";
    export default {
        name: 'Index',
        components: {
            transport
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

