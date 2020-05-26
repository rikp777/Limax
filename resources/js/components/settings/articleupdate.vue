<template>
    <div class="row">
        <div class="card">
            <form class="needs-validation" @submit.prevent="validateBeforeSubmit">
                <div class="row">
                    <div class="col">
                        <div class="form-row">
                            <div class="col mb-3">
                                <div class="card border-0 mb-3">
                                    <div class="card-body">
                                        <div class="form-row">
<!--                                            {{articles}}-->
                                            <div class="col mb-3">
                                                    <multiselect v-model="form.articles" :options="articles"
                                                                 :multiple="true"
                                                                 :close-on-select="false" :clear-on-select="false"
                                                                 :preserve-search="true"
                                                                 placeholder="Select articles" label="name"
                                                                 track-by="name"
                                                                 style="width: 600px;">
                                                        <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} article(s) selected</span></template>
                                                    </multiselect>
<!--                                                    <pre class="language-json"><code>{{ form.articles  }}</code></pre>-->
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <hr>
                                                <table class="table" v-if="form.articles.length">
                                                    <thead>
                                                    <tr>
                                                        <th slot-scope="col">#</th>
                                                        <th slot-scope="col">Name</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr v-for="article in form.articles">
                                                        <th slot-scope="row">{{article.id}}</th>
                                                        <td>{{article.name}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
<!--                                            {{articlefarmers}}-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button"class="btn btn-primary text-white" @click="routeHistory">Back</button>
                <button type="button"class="btn btn-primary text-white" @click="validateBeforeSubmit">Update</button>

<!--                <div v-for="articlefarmer in articlefarmers">{{articlefarmer}}</div>-->
<!--                {{articlefarmers}}-->
            </form>

        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex';
    import {getToken} from '../../common/jwt.service';

    export default {
        name: "profile-update",
        data() {
            return {
                form: {
                    farmerid: '',
                    articles: [],
                },
            }
        },
        computed: {
            ...mapGetters(["authUser", "isAuthenticated"]),
            articles() {
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
            this.getFarmer(getToken('farmer'));
            this.getAllArticles();
            this.getAllArticleFarmers();

            this.form.farmerid = getToken('farmer');
        },
        methods: {
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            },
            getArticlesById(id){
                return this.$store.getters.articleById(id);
            },
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            getAllArticleFarmers() {
                this.$store.dispatch("getAllArticleFarmers").then(()=>{
                    this.form.articles = this.articlefarmers;
                });
            },
            validateBeforeSubmit() {
                this.$validator.validateAll().then((result) => {
                    if (result) {
                            this.$store.dispatch("updateArticleFarmer", this.form)
                                .then(()=>{
                                    // console.log(this.form.articles);
                                    var articleReturnData = '';
                                    this.form.articles.forEach((articleReturnDataa)=>{
                                        articleReturnData += articleReturnDataa.id + ', ';
                                    });
                                    this.$swal({
                                        position: 'top-end',
                                        icon: 'success',
                                        // title: 'Article Selection\n' + articleReturnData,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                });
                    }
                })
            },
            routeHistory() {
                this.$router.go(-1);
            }
        }
    }
</script>

<style scoped>

</style>
