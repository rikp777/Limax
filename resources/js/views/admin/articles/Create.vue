<template>
    <b-row>
        <b-colxx xl="7" lg="12" class="mb-4">
            <div v-if="!update">
                <article-create/>
            </div>
            <div v-else>
                <article-update
                    :id="articleId"
                    @createMode="createListener"
                    @refreshMode="refreshListener"
                />
            </div>
        </b-colxx>
        <b-colxx xl="5" lg="12" class="mb-4">
            <b-card :title="$t('article.list.title')">
            <article-list :key="reloadComp"
                          @updateMode="updateListener"
                          @refreshMode="refreshListener"
            />
            </b-card>
        </b-colxx>
    </b-row>
</template>

<script>
    import articleCreate from "../../../components/crudl/article/ArticleCreate";
    import articleList from "../../../components/crudl/article/ArticleList";
    import articleUpdate from "../../../components/crudl/article/ArticleUpdate";
    export default {
        name: "Create",
        components: {
            articleCreate,
            articleList,
            articleUpdate
        },
        data() {
            return {
                update: false,
                articleId: null,
                reloadComp: 0,
            }
        },
        methods: {
            updateListener(id) {
                //console.log('update: ' + id)
                this.articleId = id
                this.update = true
            },
            createListener() {
                //console.log('create')
                this.update = false
            },
            refreshListener() {
                this.reloadComp += 1
            },
            getAllPalletTypes() {
                this.$store.dispatch("getAllPalletTypes");
            },
            getAllCasks() {
                this.$store.dispatch("getAllCasks");
            },
            getAllInsets() {
                this.$store.dispatch("getAllInsets");
            },
            getAllArticlegroup() {
                this.$store.dispatch("getAllArticlegroup");
            },
            getAllSorts() {
                this.$store.dispatch("getAllSorts");
            },
        },
        mounted() {
            Promise.all([
                this.getAllPalletTypes(),
                this.getAllCasks(),
                this.getAllInsets(),
                this.getAllArticlegroup(),
                this.getAllSorts()
            ]).finally(() => {
                //console.log(" nu ben ik klaar");
            })
        },
    }
</script>

<style scoped>

</style>
