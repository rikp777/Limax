<template>
    <div>

        <form v-on:submit.prevent="cellUpdate(form.cell)" autocomplete="off"
              class="text-center p-5">

        <label class="form-group has-float-label">
        <multiselect v-model="form.articles" :options="getArticles"
                     :multiple="true"
                     :close-on-select="false" :clear-on-select="false"
                     :preserve-search="true"
                     placeholder="Select articles" label="name"
                     track-by="name">
            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single"
                                                                                     v-if="values.length &amp;&amp; !isOpen">{{ values.length }} article(s) selected</span>
            </template>
        </multiselect>
            <span>{{ $t('article.connect.label') }}</span>
        </label>
<!--        <pre class="language-json"><code>{{ form.articles  }}</code></pre>-->
        <button type="button" class="btn btn-primary btn-block my-4 text-white" @click="validateBeforeSubmit">{{ $t('article.connect.actions.buttonUpdate') }}</button>

        </form>

    </div>
</template>

<script>
    export default {
        // TODO
        // this component links an article to a farmer so
        // the farmer gets a specific list of articles
        name: "FarmerArticleConnect",
        data() {
            return {
                form: {
                    articles: [],
                },
            }
        },
        computed: {
            getArticles() {
                return this.$store.getters.articles;
            },
            articlefarmers() {
                return this.$store.getters.articlefarmers;
            },
            farmer() {
                return this.$store.getters.farmer;
            },
        },
        mounted() {
            this.getAllArticles();
            this.getAllArticleFarmers();
        },
        methods: {
            getArticlesById(id) {
                return this.$store.getters.articleById(id);
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            getAllArticleFarmers() {
                this.$store.dispatch("getAllArticleFarmers").then(() => {
                    this.form.articles = this.articlefarmers;
                });
            },
            validateBeforeSubmit() {

                this.$store.dispatch("updateArticleFarmer", this.form)
                    .then(() => {
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getAllArticleFarmers();
                        this.$emit('reloadMode')
                    });
            }
        }
    }
</script>

<style scoped>

</style>
