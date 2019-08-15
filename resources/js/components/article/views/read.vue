<template>
    <div>
        <div class="container-fluid container-application">

        </div>

    </div>
</template>

<script>
    import { mapGetters } from "vuex";
    import ArticleActions from "../components/actions";
    export default {
        name: "article-read",
        components: {ArticleActions},
        computed: {
            ...mapGetters(["article"])
        },
        mounted() {
            this.$store.dispatch("getArticle", 1);
        }
    }
</script>

<style scoped>

</style>
