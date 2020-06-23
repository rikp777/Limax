<template>
    <b-card :title="$t('article.update.title') + ' : ' + getArticle.id" style="border-left: 6px solid red">
        <validation-observer ref="observer" v-slot="{ invalid }">
            <div v-if="articleIsLoading">
                <br>
                <br>
                <br>
                <br>
                <div class="loading"></div>
            </div>
            <div v-else>
            <b-form @submit.prevent="validateBeforeSubmit">

                <b-row>
                    <b-col>
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-heading">
                                <div v-if="article.sort_type_id.name === 'none'">  <!-- Reuze moet veranderd worden naar none -->
                                    <div v-if="article.inset_id">
                                        {{article.article_group_id.name + ' ' + article.inset_limit + 'x' + article.inset_gram + ' ' + article.inset_id.color + ' (' + article.excel_code + ')'}}
                                    </div>
                                    <div v-else>
                                        {{article.article_group_id.name + ' ' + article.inset_limit + 'x' + article.inset_gram + ' (' + article.excel_code + ')'}}
                                    </div>
                                </div>
                                <div v-else-if="article.sort_type_id.name === 'Kist'"> <!-- Fijn moet veranderd worden naar Kist -->
                                    {{article.article_group_id.name + ' ' + article.sort_type_id.name + ' (' + article.excel_code + ')'}}
                                </div>
                                <div v-else>
                                    <div v-if="article.inset_id">
                                        {{article.article_group_id.name + ' ' + article.inset_limit + 'x' + article.inset_gram + ' ' + article.sort_type_id.name + ' ' + article.inset_id.color + ' (' + article.excel_code + ')'}}
                                    </div>
                                    <div v-else>
                                        {{article.article_group_id.name + ' ' + article.inset_limit + 'x' + article.inset_gram + ' ' + article.sort_type_id.name + ' (' + article.excel_code + ')'}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.excel_code')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <label class="form-group has-float-label mb-4">
                                <input type="text" class="form-control" v-model="article.excel_code" id="excel_code"
                                       name="excel_code"
                                       :state="getValidationState(validationContext)"
                                       aria-describedby="excel_code-live-feedback"
                                       placeholder="AB123NL">
                                <span>{{ $t('article.attributes.excel_code') }}</span>
                            </label>
                            <b-form-invalid-feedback id="excel_code-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.origin')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <label class="form-group has-float-label mb-4">
                                <input type="text" class="form-control" v-model="article.origin" id="origin"
                                       name="origin" :state="getValidationState(validationContext)"
                                       aria-describedby="origin-live-feedback" placeholder="NL">
                                <span>{{ $t('article.attributes.origin') }}</span>
                            </label>
                            <b-form-invalid-feedback id="origin-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.inset_limit')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <label class="form-group has-float-label mb-4">
                                <input type="number" class="form-control" v-model="article.inset_limit" id="inset_limit"
                                       name="inset_limit"
                                       :state="getValidationState(validationContext)"
                                       aria-describedby="inset_limit-live-feedback" placeholder="1">
                                <span>{{ $t('article.attributes.inset_limit') }}</span>
                            </label>
                            <b-form-invalid-feedback id="inset_limit-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.inset_gram')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <label class="form-group has-float-label mb-4">
                                <input type="number" class="form-control" v-model="article.inset_gram" id="inset_gram"
                                       name="inset_gram"
                                       :state="getValidationState(validationContext)"
                                       aria-describedby="inset_gram-live-feedback" placeholder="2500">
                                <span>{{ $t('article.attributes.inset_gram') }}</span>
                            </label>
                            <b-form-invalid-feedback id="inset_gram-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.pallet_type_id')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <!--                    <label class="form-group has-float-label mb-4"></label>-->
                            <multiselect class="form-group has-float-label mb-4" v-model="article.pallet_type_id" :options="palletTypes" :multiple="false"
                                         :close-on-select="true" :allow-empty="false"
                                         placeholder="Select pallet type" label="description" track-by="description"
                                         :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                    class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} pallet type selected</span>
                                </template>
                            </multiselect>
                            <!--                        <span>{{ $t('article.attributes.pallet_type_id.title') }}</span>-->
                            <b-form-invalid-feedback id="pallet_type_id-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.pallet_limit')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <label class="form-group has-float-label mb-4">
                                <input type="number" class="form-control" v-model="article.pallet_limit" id="pallet_limit"
                                       name="pallet_limit" :state="getValidationState(validationContext)"
                                       aria-describedby="pallet_limit-live-feedback" placeholder="170">
                                <span>{{ $t('article.attributes.pallet_limit') }}</span>
                            </label>
                            <b-form-invalid-feedback id="pallet_limit-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.cask_id')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <!--                    <label class="form-group has-float-label mb-4"></label>-->
                            <multiselect class="form-group has-float-label mb-4" v-model="article.cask_id" :options="casks" :multiple="false"
                                         :close-on-select="true" :allow-empty="false"
                                         placeholder="Select cask" label="description" track-by="description"
                                         :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                    class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} cask selected</span>
                                </template>
                            </multiselect>
                            <!--                                            <span>{{ $t('article.attributes.pallet_type_id.title') }}</span>-->
                            <b-form-invalid-feedback id="cask_id-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.inset_id')"
                            :rules="{ required: false }"
                            v-slot="validationContext"
                        >
                            <!--                    <label class="form-group has-float-label mb-4"></label>-->
                            <multiselect class="form-group has-float-label mb-4" v-model="article.inset_id" :options="insets" :multiple="false"
                                         :close-on-select="true" :allow-empty="false"
                                         placeholder="Select inset" label="description" track-by="description"
                                         :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                    class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} inset selected</span>
                                </template>
                            </multiselect>
                            <!--                                            <span>{{ $t('article.attributes.pallet_type_id.title') }}</span>-->
                            <b-form-invalid-feedback id="inset_id-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                </b-row>

                <b-row>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.article_group_id')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <!--                    <label class="form-group has-float-label mb-4"></label>-->
                            <multiselect class="form-group has-float-label mb-4" v-model="article.article_group_id" :options="articlegroups" :multiple="false"
                                         :close-on-select="true" :allow-empty="false"
                                         placeholder="Select article group" label="description" track-by="description"
                                         :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                    class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} article group selected</span>
                                </template>
                            </multiselect>
                            <!--                                            <span>{{ $t('article.attributes.pallet_type_id.title') }}</span>-->
                            <b-form-invalid-feedback id="article_group_id-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                    <b-col>
                        <validation-provider
                            :name="$t('article.attributes.sort_type_id')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <!--                    <label class="form-group has-float-label mb-4"></label>-->
                            <multiselect class="form-group has-float-label mb-4" v-model="article.sort_type_id" :options="sorts" :multiple="false"
                                         :close-on-select="true" :allow-empty="false"
                                         placeholder="Select sort type" label="description" track-by="description"
                                         :preselect-first="false">
                                <template slot="selection" slot-scope="{ values, search, isOpen }"><span
                                    class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} sort type selected</span>
                                </template>
                            </multiselect>
                            <!--                                            <span>{{ $t('article.attributes.pallet_type_id.title') }}</span>-->
                            <b-form-invalid-feedback id="sort_type_id-live-feedback">{{ validationContext.errors[0] }}
                            </b-form-invalid-feedback>
                        </validation-provider>
                    </b-col>
                </b-row>
<!--                <b-row>-->
<!--                    <b-col>-->
<!--                    </b-col>-->
<!--                    <b-col>-->
<!--                    </b-col>-->
<!--                </b-row>-->
                <div class="d-flex justify-content-end align-items-center">
                    <b-button
                        type="button"
                        variant="outline-danger"
                        class="ml-1"
                        @click="cancel"
                    >{{ $t('article.actions.buttonCancel') }}
                    </b-button>
                    <b-button type="submit" variant="primary" size="lg" class="btn-shadow">{{
                        $t('article.actions.buttonUpdate')}}
                    </b-button>
                </div>
            </b-form>
            </div>
        </validation-observer>
    </b-card>
</template>

<script>
    export default {
        name: "ArticleUpdate",
        props: ['id'],
        data() {
            return {
                article: {
                    id: this.id,
                    excel_code: '',
                    inset_gram: '',
                    inset_limit: '',
                    pallet_limit: 170,
                    origin: '',
                    pallet_type_id: null,
                    cask_id: null,
                    inset_id: null,
                    status_id: 8,
                    article_group_id: null,
                    sort_type_id: null,
                    user_id: 1,
                },
                serverErrors: '',
                updateMode: true,
            }
        },
        computed: {
            authUser() {
                return this.$store.getters.authUser;
            },
            articleIsLoading() {
                return this.$store.getters.articleIsLoading;
            },
            getArticle() {
                return this.$store.getters.article;
            },
            palletTypes() {
                return this.$store.getters.palletTypes;
            },
            casks() {
                return this.$store.getters.casks;
            },
            insets() {
                return this.$store.getters.insets;
            },
            articlegroups() {
                return this.$store.getters.articlegroups;
            },
            sorts() {
                return this.$store.getters.sorts;
            }
        },
        methods: {
            getValidationState({dirty, validated, valid = null}) {
                return dirty || validated ? valid : null;
            },
            validateBeforeSubmit() {
                this.update();
            },
            update() {
                this.$store.dispatch("updateArticle", this.article)
                    .then(()=> {
                        this.getAllArticles();
                        this.cancel()
                    });
            },
            getArticleMethod() {
                this.$store.dispatch("getArticle", this.id)
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
            getAllArticles() {
                this.$store.dispatch("getAllArticles");
            },
            cancel() {
                this.$emit('refreshMode')
                this.$emit('createMode')
            }
        },
        mounted() {
            Promise.all([
                // this.getAllPalletTypes(),
                // this.getAllCasks(),
                // this.getAllInsets(),
                // this.getAllArticlegroup(),
                // this.getAllSorts(),
                // this.getArticleMethod(),
                this.$store.dispatch("getArticle", this.id).then(()=>{
                    //console.log("nu dit");
                })
            ]).finally(() => {
                console.log(this.getArticle);
                this.article.excel_code = this.getArticle.excelCode;
                this.article.inset_gram = this.getArticle.weight;
                this.article.inset_limit = this.getArticle.insetLimit;
                this.article.pallet_limit = this.getArticle.palletLimit;
                this.article.origin = this.getArticle.origin;
                this.article.pallet_type_id = this.getArticle.palletType;
                this.article.cask_id = this.getArticle.cask;
                if(this.getArticle.inset){
                    this.article.inset_id = this.getArticle.inset;
                }
                this.article.status_id = this.getArticle.status;
                this.article.article_group_id = this.getArticle.articleGroup;
                this.article.sort_type_id = this.getArticle.sortType;
                    // this.article.excel_code = this.getArticle.excelCode;
                    // this.article.inset_gram = this.getArticle.weight;
                    // this.article.inset_limit = this.getArticle.insetLimit;
                    // this.article.pallet_limit = this.getArticle.palletLimit;
                    // this.article.origin = this.getArticle.origin;
                    // this.article.pallet_type_id.push(this.getArticle.palletType);
                    // this.article.cask_id.push(this.getArticle.cask);
                    // if(this.getArticle.inset){
                    //     this.article.inset_id.push(this.getArticle.inset);
                    // }
                    // this.article.status_id = this.getArticle.status;
                    // this.article.article_group_id.push(this.getArticle.articleGroup);
                    // this.article.sort_type_id.push(this.getArticle.sortType);
                console.log(this.article);
            })
        },
    }
</script>

<style scoped>
    .loading {
        display: inline-block !important;
        width: 30px !important;
        height: 30px !important;
        border-radius: 50% !important;
        animation: spin 1s ease-in-out infinite !important;
        -webkit-animation: spin 1s ease-in-out infinite !important;
        position: absolute !important;
        z-index: 1 !important;
    }
</style>
