<template>
    <div id="app-container" :class="getMenuType">
        <top-nav />
<!--        <sidebar />-->
        <main>
            <div class="container-fluid">
                <div class="row">
                    <b-colxx xl="12" lg="12" md="12" class="mb-4">
                        <b-card class="h-100">
                            <div class="dashboard-donut-chart">
                                <b-refresh-button @click="refreshButtonClick"/>
                                <table style="width:100%">
                                    <tr>
                                        <th>Bedrijfsnaam</th>
                                        <th>PalletNr</th>
                                        <th>Plukdatum</th>
                                        <th>Aantal</th>
                                        <th>Artikel</th>
                                    </tr>
                                    <tr v-for="(data, key) in logistics.data.totalLabels">
                                        <td v-for="dat in data">{{dat}}</td>
                                    </tr>
                                </table>
                            </div>
                        </b-card>
                    </b-colxx>
                </div>
                <br>
                <div class="row">
                    <b-colxx xl="4" lg="4" md="4" class="mb-4">
                        <b-card class="h-100">
                            <div class="dashboard-donut-chart">
                                <b-refresh-button @click="refreshButtonClick"/>
                                <table style="width:20%; float: left;">
                                    <tr>
                                        <th>Aantal Pallets</th>
                                    </tr>
                                    <tr v-for="(data, key) in logistics.data.totalLabelsCount">
                                        <td v-for="dat in data">{{dat}}</td>
                                    </tr>
                                </table>
                            </div>
                        </b-card>
                    </b-colxx>

                    <b-colxx xl="8" lg="8" md="8" class="mb-4">
                        <b-card class="h-100">
                            <div class="dashboard-donut-chart">
                                <b-refresh-button @click="refreshButtonClick"/>
                                <table style="width:80%; float: right;">
                                    <tr>
                                        <th>Artikel</th>
                                        <th>Aantal</th>
                                    </tr>
                                    <tr v-for="(data, key) in logistics.data.totalArticles">
                                        <td v-for="dat in data">{{dat}}</td>
                                    </tr>
                                </table>
                            </div>
                        </b-card>
                    </b-colxx>
                </div>
            </div>
        </main>
        <footer-component />
    </div>
</template>

<script>
    import Sidebar from '../../containers/menu/logistics/Sidebar'
    import TopNav from '../../containers/menu/logistics/TopNav'
    import Footer from '../../containers/Footer'
    import {
        mapActions,
        mapGetters, mapMutations
    } from 'vuex'

    export default {
        components: {
            'top-nav': TopNav,
            'sidebar': Sidebar,
            'footer-component': Footer
        },
        data() {
            return {
                show: false
            }
        },
        computed: {
            // ...mapGetters(['getMenuType'])
            ...mapGetters({
                getMenuType: 'getMenuType',
                authFarmer: 'authFarmer',
                authUserFarmers: 'authUserFarmers',
                logisticIsLoading: 'logisticIsLoading'
            }),
            logistics() {
                return this.$store.getters.logistics;
            }
        },
        methods: {
            getAllLogistics() {
                this.$store.dispatch("getAllLogistics")
            },
            getArticlesById(id){
                return this.$store.getters.articleById(id);
            },
        },
        mounted() {
            this.getAllLogistics()
        },
    }
</script>
