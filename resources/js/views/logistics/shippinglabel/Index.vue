<template>
<!--    <b-card :title="$t('menu.planning.main')">-->
        <shippinglabel></shippinglabel>
<!--    </b-card>-->
</template>
<script>
    import shippinglabel from "../../../components/crudl/logistics/ShippinglabelPdf";
    export default {
        name: 'Index',
        components: {
            shippinglabel
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
