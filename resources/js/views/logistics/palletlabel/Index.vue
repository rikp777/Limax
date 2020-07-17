<template>
<!--    <b-card :title="$t('menu.planning.main')">-->
        <palletlabel></palletlabel>
<!--    </b-card>-->
</template>
<script>
    import palletlabel from "../../../components/crudl/logistics/PalletlabelPdf";
    export default {
        name: 'Index',
        components: {
            palletlabel
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
