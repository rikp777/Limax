<template>
    <div>

        <h6>{{$t('cell.main.title')}}</h6>
        <hr>
        <b-row>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('cell.create.title')">
                    <farmer-cell-create />
                </b-card>
            </b-colxx>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('cell.list.title')">
                    <farmer-cell-list />
                </b-card>
            </b-colxx>
        </b-row>


        <h6>{{$t('article.main.title')}}</h6>
        <hr>
        <b-row>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('article.connect.title')">
                    <farmer-article-connect />
                </b-card>
            </b-colxx>
            <b-colxx xl="6" lg="12" class="mb-4">
                <b-card :title="$t('article.create.title')">
                    <farmer-article-list />
                </b-card>
            </b-colxx>
        </b-row>

    </div>
</template>

<script>
    import FarmerCellCreate from "../../../components/crudl/farmer/FarmerCellCreate";
    import FarmerCellList from "../../../components/crudl/farmer/FarmerCellList";
    import FarmerArticleConnect from "../../../components/crudl/farmer/FarmerArticleConnect";
    import FarmerArticleList from "../../../components/crudl/farmer/FarmerArticleList";
    export default {
        name: "overview",
        components: {
            FarmerArticleList,
            FarmerArticleConnect,
            FarmerCellList,
            FarmerCellCreate
        }
    }
</script>

<style scoped>

</style>
