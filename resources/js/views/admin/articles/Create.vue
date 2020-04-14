<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4">
            <article-create />
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <article-list />
        </b-colxx>
    </b-row>
</template>

<script>
    import articleCreate from "../../../components/crudl/article/ArticleCreate";
    import articleList from "../../../components/crudl/article/ArticleList";
    export default {
        name: "Create",
        components: {
            articleCreate,
            articleList
        }
    }
</script>

<style scoped>

</style>
