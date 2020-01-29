<template>
    <div>
        <b-row>
            <b-colxx xl="6" lg="12">
                <palletlabel-create />
            </b-colxx>
            <b-colxx xl="6" lg="12" class="md-4">
                <palletlabel-list />
            </b-colxx>
        </b-row>
    </div>
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
