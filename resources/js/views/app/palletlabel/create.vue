<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4">
            <palletlabel-create />
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <palletlabel-list />
        </b-colxx>
    </b-row>
</template>
<script>
    import PalletlabelCreate from "../../../components/crudl/palletlabel/Create";
    import PalletlabelList from "../../../components/crudl/palletlabel/List"
    export default {
        components: {
            PalletlabelCreate,
            PalletlabelList
        }
    }
</script>
