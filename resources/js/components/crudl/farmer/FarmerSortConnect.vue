<template>
    <div>

        <form v-on:submit.prevent="sortUpdate(form.sorts)" autocomplete="off"
              class="text-center p-5">

        <multiselect class="form-group has-float-label" v-model="form.sorts" :options="getSorts"
                     :multiple="true"
                     :close-on-select="false" :clear-on-select="false"
                     :preserve-search="true"
                     placeholder="Select sorts" label="name"
                     track-by="name">
            <template slot="selection" slot-scope="{ values, search, isOpen }"><span class="multiselect__single"
                                                                                     v-if="values.length &amp;&amp; !isOpen">{{ values.length }} sort(s) selected</span>
            </template>
        </multiselect>
<!--            <span>{{ $t('sort.connect.label') }}</span>-->
<!--        <pre class="language-json"><code>{{ form.articles  }}</code></pre>-->
        <button type="button" class="btn btn-primary btn-block my-4 text-white" @click="validateBeforeSubmit">{{ $t('sort.connect.actions.buttonUpdate') }}</button>

        </form>

    </div>
</template>

<script>
    export default {
        // TODO
        // this component links an article to a farmer so
        // the farmer gets a specific list of articles
        name: "FarmerSortConnect",
        data() {
            return {
                form: {
                    sorts: [],
                },
            }
        },
        computed: {
            getSorts() {
                return this.$store.getters.sorts;
            },
            sortfarmers() {
                return this.$store.getters.sortfarmers;
            },
            farmer() {
                return this.$store.getters.farmer;
            },
        },
        mounted() {
            this.getAllSorts();
            this.getAllSortFarmers();
        },
        methods: {
            getSortsById(id) {
                return this.$store.getters.sortById(id);
            },
            getAllSorts() {
                this.$store.dispatch("getAllSorts");
            },
            getAllSortFarmers() {
                this.$store.dispatch("getAllSortFarmers").then(() => {
                    // console.log(this.sortfarmers);
                    this.form.sorts = this.sortfarmers;
                });
            },
            validateBeforeSubmit() {

                this.$store.dispatch("updateSortFarmer", this.form)
                    .then(() => {
                        this.$swal({
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getAllSortFarmers();
                        this.$emit('reloadMode')
                    });
            }
        }
    }
</script>

<style scoped>

</style>
