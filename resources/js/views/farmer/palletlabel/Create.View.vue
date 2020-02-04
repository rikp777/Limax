<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4">
            <div class="$t('palletlabel.create.title')">
                <palletlabel-create />
            </div>
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <b-card :title="$t('palletlabel.list.title')">
                <farmer-palletlabel-list />
            </b-card>
        </b-colxx>
    </b-row>
</template>
<script>
    import PalletlabelCreate from "../../../components/crudl/palletlabel/PalletlabelCreate";
    import FarmerPalletlabelList from "../../../components/crudl/farmer/FarmerPalletlabelList"
    export default {
        components: {
            PalletlabelCreate,
            FarmerPalletlabelList
        }
    }
</script>
