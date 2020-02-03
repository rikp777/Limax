<template>
    <b-row>
        <b-colxx xl="6" lg="12" class="mb-4">
            <cell-create/>
        </b-colxx>
    </b-row>
</template>

<script>
    import cellCreate from "../../../components/crudl/farmer/cell/Create";
    export default {
        name: "overview",
        components: {
            cellCreate
        }
    }
</script>

<style scoped>

</style>
