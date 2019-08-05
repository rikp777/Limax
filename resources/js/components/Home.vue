<template>
    <div class="card">
        <div class="card-body">
            <template v-if="isLoading">
                <div class="spinner-grow text-dark" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </template>
            <template v-else>
                <h5 class="card-title">{{articles}}</h5>
            </template>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        name: "Home",
        computed: {
            articles(){
                return this.$store.getters.articles
            },
            isLoading(){
                return this.$store.getters.isLoading
            }
        },
        mounted() {
            this.getAllArticles();
        },
        methods: {
            getAllArticles(){
                this.$store.dispatch("getAllArticles");
            }
        }
    }
</script>
