<template>
    <b-card :title="$t('article.create.title')">
        <validation-observer ref="observer" v-slot="{ invalid }">
            <b-form @submit.prevent="validateBeforeSubmit">

                <b-row>
                    <b-col>
                        <div class="alert alert-primary" role="alert">
                            <div class="alert-heading">
                                <div v-if="article.sort_type_id.name === 'Reuze'">  <!-- Reuze moet veranderd worden naar none -->
                                    <div v-if="article.inset_id.color">
                                        {{article.article_group_id.name + ' ' + article.inset_limit + 'x' + article.inset_gram + ' ' + article.inset_id.color + ' (' + article.excel_code + ')'}}
                                    </div>
                                    <div v-else>
                                        {{article.article_group_id.name + ' ' + article.inset_limit + 'x' + article.inset_gram + ' (' + article.excel_code + ')'}}
                                    </div>
                                </div>
                                <div v-else-if="article.sort_type_id.name === 'Fijn'"> <!-- Fijn moet veranderd worden naar Kist -->
                                    {{article.article_group_id.name + ' ' + article.sort_type_id.name + ' (' + article.excel_code + ')'}}
                                </div>
                                <div v-else>
                                    <div v-if="article.inset_id.color">
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
                                         placeholder="Selecteer pallet type" label="description" track-by="description"
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
                            :name="$t('article.attributes.cask_id.title')"
                            :rules="{ required: true }"
                            v-slot="validationContext"
                        >
                            <!--                    <label class="form-group has-float-label mb-4"></label>-->
                            <multiselect class="form-group has-float-label mb-4" v-model="article.cask_id" :options="casks" :multiple="false"
                                         :close-on-select="true" :allow-empty="false"
                                         placeholder="Selecteer fust" label="description" track-by="description"
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
                            :name="$t('article.attributes.inset_id.title')"
                            :rules="{ required: false }"
                            v-slot="validationContext"
                        >
                            <!--                    <label class="form-group has-float-label mb-4"></label>-->
                            <multiselect class="form-group has-float-label mb-4" v-model="article.inset_id" :options="insets" :multiple="false"
                                         :close-on-select="true" :allow-empty="false"
                                         placeholder="Selecteer inzet" label="description" track-by="description"
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
                                         placeholder="Selecteer artikel groep" label="description" track-by="description"
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
                                         placeholder="Selecteer sortering" label="description" track-by="description"
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
                    <b-button type="submit" variant="primary" size="lg" class="btn-shadow" :disabled="invalid">{{
                        $t('article.actions.buttonCreate')}}
                    </b-button>
                </div>
            </b-form>
        </validation-observer>
    </b-card>
</template>

<script>
    export default {
        name: "ArticleCreate",
        data() {
            return {
                article: {
                    excel_code: '',
                    inset_gram: '',
                    inset_limit: '',
                    pallet_limit: 170,
                    origin: '',
                    pallet_type_id: [],
                    cask_id: [],
                    inset_id: [],
                    status_id: 8,
                    article_group_id: [],
                    sort_type_id: [],
                    user_id: 1,
                },
                serverErrors: '',
            }
        },
        computed: {
            authUser() {
                return this.$store.getters.authUser;
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
                this.create();
            },
            create() {
                this.$store.dispatch('createArticle', {
                    excel_code: this.article.excel_code,
                    inset_gram: this.article.inset_gram,
                    inset_limit: this.article.inset_limit,
                    pallet_limit: this.article.pallet_limit,
                    origin: this.article.origin,
                    pallet_type_id: this.article.pallet_type_id,
                    cask_id: this.article.cask_id,
                    inset_id: this.article.inset_id,
                    status_id: this.article.status_id,
                    article_group_id: this.article.article_group_id,
                    sort_type_id: this.article.sort_type_id,
                    user_id: this.article.user_id,
                }).then(response => {
                    // this.$router.push({ name: 'userList'})
                    // this.$emit('refreshMode');
                    this.article.excel_code = '';
                    this.article.inset_gram = '';
                    this.article.inset_limit = '';
                    this.article.pallet_limit = 170;
                    this.article.origin = '';
                    this.article.pallet_type_id = [];
                    this.article.cask_id = [];
                    this.article.inset_id = [];
                    this.article.status_id = 8;
                    this.article.article_group_id = [];
                    this.article.sort_type_id = [];
                    this.article.user_id = 1;
                })
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
            // Promise.all([
            //     this.getAllPalletTypes(),
            //     this.getAllCasks(),
            //     this.getAllInsets(),
            //     this.getAllArticlegroup(),
            //     this.getAllSorts()
            // ]).finally(() => {
            //     //console.log(" nu ben ik klaar");
            // })
        },
    }
</script>

<style scoped>

</style>
