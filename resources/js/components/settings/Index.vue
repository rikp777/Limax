<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white">
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <button type="button" class="btn btn-primary btn-lg nav-link" @click="componentShow = 'Cells'">Cells</button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="btn btn-primary btn-lg nav-link" @click="componentShow = 'Articles'">Articles</button>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="card-body" v-if="componentShow">
                        <div v-if="componentShow === 'Cells'">
                            <h5 class="card-title">{{farmer.name}} : Cells Config</h5>
                            <SettingsCellUpdate></SettingsCellUpdate>
                        </div>
                        <div v-if="componentShow === 'Articles'">
                            <h5 class="card-title">{{farmer.name}} : Articles Selection</h5>
                            <SettingsArticleUpdate></SettingsArticleUpdate>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Connections</h5>
                        <ul v-for="(farmer, index) in farmers">
                            <li>{{farmer.name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import SettingsCellUpdate from "./cellupdate";
    import SettingsArticleUpdate from "./articleupdate";
    import {getToken} from '../../common/jwt.service';

    export default {
        name: "Index",
        components: {SettingsCellUpdate, SettingsArticleUpdate},
        props: ['farmers'],
        data() {
            return {
                form: {

                },
                componentShow: null
            }
        },
        computed: {
            farmer() {
                return this.$store.getters.farmer;
            },
        },
        mounted() {
            this.getFarmer(getToken('farmer'))
        },
        methods: {
            getFarmer(id) {
                this.$store.dispatch("getFarmer", id);
            }
        }
    }
</script>

<style scoped>
    .card-header .fas {
        transition: .3s transform ease-in-out;
    }

    .card-header .collapsed .fas {
        transform: rotate(90deg);
    }
</style>
